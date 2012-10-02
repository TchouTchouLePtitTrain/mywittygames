<?php

namespace Witty\TransactionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use JMS\SecurityExtraBundle\Annotation\Secure;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Witty\TransactionBundle\Entity\Ipn;
use Witty\TransactionBundle\Entity\Transaction;
use Witty\ProjectBundle\Entity\UserReward;

class TransactionController extends Controller
{	
	
    /**
     * @Route("/success", name="transaction_success")
     */
    public function successAction()
    {
	
		$logger = new Logger('paypalSuccessLogger');
		$logger->pushHandler(new StreamHandler($this->container->getParameter('witty.paypal.log.success.path'), Logger::INFO));

		$logger->info("IPN re�u le ".date('d/m/y � G:i:s'));
		
		$em = $this->getDoctrine()->getEntityManager();
		$request = $this->getRequest();
		
		//Fausse requ�te pour simuler un IPN (pour les tests en dev uniquement)
		//$request = new \Symfony\Component\HttpFoundation\Request(array(), array('txn_id' => '5487', 'mc_gross' => '60.77', 'custom' => 'u=3&rw=1&opt=1,2'));		

		if (!$request->getMethod() == 'POST')
			throw new \Exception('Erreur');
			
		if ($request->get('txn_id')) $this->processPaypal($request, $logger, $this->container->getParameter('witty.paypal.url')); //Si on vient de paypal, sauvegarde l'IPN re�u et renvoie la confirmation � Paypal
		$transaction = $this->creerTransaction($request, $logger); //Cr�e la Transaction

		if ($this->verifierTransaction($transaction, $logger, $request)) //V�rification de la validit� de la transaction
		{
			//Enregistrement de la transaction
			$transaction->setCompletionDate(new \DateTime());
			$transaction->setCompleted(true);
			$em->persist($transaction);
			
			$logger->info("Transaction OK");

			//Traitements post-transaction
			$this->processPostTransaction($transaction, $logger); //Ajout des rewards et options achet�s au User
		}
		
		return new \Symfony\Component\HttpFoundation\Response('ok');
	}
	
	
	//Sauvegarde l'IPN re�u et renvoie la confirmation � Paypal
	private function processPaypal($request, $logger, $urlPaypal)
	{
		$em = $this->getDoctrine()->getEntityManager();		
			
		$req = 'cmd=_notify-validate';
		$var = "";
		$paypalTransactionId = "";
		
		foreach ($request->request->all() as $key => $value) 
		{
			$req .= "&$key=$value";
			$var .= "$key = $value <br />";
		}
		
		$logger->info("Requ�te : ".$req);
		
		$ipn = new Ipn($req);
		$em->persist($ipn);

		$logger->info("IPN stock� : ".$ipn->getId());
		
		//Renvoi � Paypal
		$header = "POST /cgi-bin/webscr HTTP/1.0\r\n";
		$header .= "Content-Type: application/x-www-form-urlencoded\r\n";
		$header .= "Content-Length: " . strlen($req) . "\r\n\r\n";

		$fp = fsockopen ('ssl://www.sandbox.paypal.com', '443', $errno, $errstr, 30);
		
		$logger->info("Socket ouvert avec Paypal");

		if (!$fp) 
		{
			$logger->info("Erreur HTTP");
			throw new \Exception("Erreur HTTP - ouverture socket paypal");
		} 
		else 
		{
			fputs($fp, $header . $req);
			while (!feof($fp)) 
			{
				$res = fgets($fp, 1024);
				if ( strcmp($res, "VERIFIED") == 0 ) 
				{
					$logger->info("Transaction valide");
				}
				else if ( strcmp ($res, "INVALID") == 0 ) 
				{
					$logger->info("Transaction invalide");
					throw new \Exception("Erreur paypal: Transaction invalide");             
				}
			}
			fclose($fp);
		}
		
		return true;
	}
	
	
	//Cr�e la Transaction
	private function creerTransaction($request, $logger)
	{
		$em = $this->getDoctrine()->getEntityManager();
		
		//R�cup�ration des ids du reward et des options
		$custom = $request->get('custom');

		$logger->info("Custom : ".$custom);		
	
		$chaine_temp_user = substr($custom, strpos($custom, 'u=') + strlen('u='), strlen($custom) - (strpos($custom, 'u=') + strlen('u=')));
		$userId = (int) substr($chaine_temp_user, 0, min(strpos($chaine_temp_user, '&'), strlen($chaine_temp_user)));
		
		$chaine_temp_reward = substr($custom, strpos($custom, 'rw=') + strlen('rw='), strlen($custom) - (strpos($custom, 'rw=') + strlen('rw=')));
		$rewardId = (int) substr($chaine_temp_reward, 0, min(strpos($chaine_temp_reward, '&'), strlen($chaine_temp_reward)));
	
		$optionsIdsString = substr($custom, strpos($custom, 'opt=') + strlen('opt='), strlen($custom) - (strpos($custom, 'opt=') + strlen('opt=')));
		
		$logger->info("userId : ".$userId);	
		$logger->info("rewardId : ".$rewardId);	
		$logger->info("optionsIdsString : ".$optionsIdsString);	
		
		$optionsIds = array();
		
		while ($optionsIdsString)
		{
			$optionsIds[] = (int) substr($optionsIdsString, 0, 1);
			$optionsIdsString = substr($optionsIdsString, 2, strlen($optionsIdsString));
		}
		
		//R�cup�ration des acteurs de la transaction
		$user = $em->getRepository('WittyUserBundle:User')->find($userId);
		$reward = $em->getRepository('WittyProjectBundle:Reward')->find($rewardId);
		$options = $em->getRepository('WittyProjectBundle:RewardOption')->findBy(array('id' => $optionsIds));

		$logger->info("Acteurs r�cup�r�s");			
		
		//Cr�ation de la transaction
		$transaction = new Transaction($this->container->getParameter('witty.paypal.fees'));
		$transaction->setPaypalId($request->get('txn_id'));
		$transaction->setUser($user);
		
			//Ajout des rewards
		$transaction->addReward($reward);

			//Ajout des options
		foreach($options as $option)
			$transaction->addOption($option);
	
		$logger->info("Transaction cr��e");	
		
		return $transaction;
	}
	
	
	
	//Proc�de aux v�rifications avant de cr�er une transaction
	private function verifierTransaction(Transaction $transaction, $logger, $request)
	{		
		$em = $this->getDoctrine()->getEntityManager();
	
		//V�rification transaction d�j� re�ue ?
		if ( $request->get('txn_id') && ($em->getRepository('WittyTransactionBundle:Transaction')->find($transaction->getPaypalId())) ) //Si la transaction vient de Paypal, la diff�rence entre le montant envoy� par Paypal et celui que l'on a recalcul� sur la base des rewards et des options d�passe les erreurs d'arrondi
		{
			$logger->err('Transaction d�j� re�ue -> id: '.$transaction->getPaypalId());
			$logger->info("Transaction KO");	
			
			throw new \Exception("Erreur: transaction d�j� re�ue");
		}
	
		//V�rification des montants
		if (!(abs($transaction->getTotalAmount() - $request->get('mc_gross')) <= 0.05)) //Si la diff�rence entre le montant envoy� par Paypal et celui que l'on a recalcul� sur la base des rewards et des options d�passe les erreurs d'arrondi
		{
			$logger->err("Montant Paypal incorrect -> Montant de la transaction :".$transaction->getTotalAmount().", Montant envoy� par Paypal:".$request->get('mc_gross'));
			$logger->info("Transaction KO");	
			
			throw new \Exception("Erreur de montant paypal");
		}
	
		return true;
	}
	
	
	//Effectue les traitements postTransaction
	private function processPostTransaction(Transaction $transaction, $logger)
	{
		$em = $this->getDoctrine()->getEntityManager();
		
		//Ajout des rewards et options achet�s au User
		$userReward = new UserReward();
		$userReward->setUser($transaction->getUser());
		$userReward->setReward($transaction->getRewards()->first());
		$transaction->getUser()->addUserReward($userReward);
		
		foreach($transaction->getOptions() as $option)
			$transaction->getUser()->addRewardOption($option);
		
		//D�cr�mentation du cr�dit du user du montant utilis�
		$transaction->getUser()->setCredit($transaction->getUser()->getCredit() - $transaction->getCreditUsed());
		
		$em->persist($transaction->getUser());
		$em->flush();
		
		$logger->info("Affectation de ses achats au User OK");
	}
	
	
    /**
     * @Route("/cancel", name="transaction_cancel")
     */
    public function cancelAction()
    {

		return new \Symfony\Component\HttpFoundation\Response('ok');
	}		
	
    /**
     * @Route("/cancel", name="transaction_return")
     */
    public function returnAction()
    {

		return new \Symfony\Component\HttpFoundation\Response('ok');
	}	
}
