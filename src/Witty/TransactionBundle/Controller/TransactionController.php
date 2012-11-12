<?php

namespace Witty\TransactionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use JMS\SecurityExtraBundle\Annotation\Secure;
use JMS\SecurityExtraBundle\Annotation\SecureParam;
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

		$logger->info("IPN reçu le ".date('d/m/y à G:i:s'));
		
		$em = $this->getDoctrine()->getEntityManager();
		$request = $this->getRequest();
		
		//Fausse requête pour simuler un IPN (pour les tests en dev uniquement)
		// $request = new \Symfony\Component\HttpFoundation\Request(array(), array('txn_id' => '05U12926LH4163820', 'mc_gross' => '56.65', 'custom' => 'u=652&rw=5'));		

		if (!$request->getMethod() == 'POST')
			throw new \Exception('Erreur');
			
		if ($request->get('txn_id')) $this->processPaypal($request, $logger, $this->container->getParameter('witty.paypal.url')); //Si on vient de paypal, sauvegarde l'IPN reçu et renvoie la confirmation à Paypal
		$transaction = $this->creerTransaction($request, $logger); //Crée la Transaction

		if ($this->verifierTransaction($transaction, $logger, $request)) //Vérification de la validité de la transaction
		{
			//Enregistrement de la transaction
			$transaction->setCompletionDate(new \DateTime());
			$transaction->setCompleted(true);
			$em->persist($transaction);
			
			$logger->info("Transaction OK");

			//Traitements post-transaction
			$this->processPostTransaction($transaction, $logger); //Ajout des rewards et options achetés au User
		}
		
		return $this->redirect($this->generateUrl('transaction_success_information', array('projectId' => $transaction->getRewards()->first()->getProject()->getId())));
	}
	
    /**
     * @Route("/success-information/{projectId}", requirements={"id" = "\d+"}, name="transaction_success_information")
     */
    public function successInformationAction($projectId)
    {
		$project = $this->getDoctrine()->getRepository("WittyProjectBundle:Project")->find($projectId);
	
		return $this->render('WittyTransactionBundle:Transaction:success.html.twig', 
			array(
				'project' => $project
			));
	}	

	
	
	//Sauvegarde l'IPN reçu et renvoie la confirmation à Paypal
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
		
		$logger->info("Requête : ".$req);
		
		$ipn = new Ipn($req);
		$em->persist($ipn);

		$logger->info("IPN stocké : ".$ipn->getId());
		
		//Renvoi à Paypal
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
	
	
	//Crée la Transaction
	private function creerTransaction($request, $logger)
	{
		$em = $this->getDoctrine()->getEntityManager();
		
		//Récupération des ids du reward et des options
		$custom = $request->get('custom');

		$logger->info("Custom : ".$custom);		
	
		$chaine_temp_user = substr($custom, strpos($custom, 'u=') + strlen('u='), strlen($custom) - (strpos($custom, 'u=') + strlen('u=')));
		$userId = (int) substr($chaine_temp_user, 0, min(strpos($chaine_temp_user, '&'), strlen($chaine_temp_user)));
		
		$chaine_temp_reward = substr($custom, strpos($custom, 'rw=') + strlen('rw='), strlen($custom) - (strpos($custom, 'rw=') + strlen('rw=')));
		if (strpos($chaine_temp_reward, '&') === false) $rewardId = (int) substr($chaine_temp_reward, 0, strlen($chaine_temp_reward));
		else $rewardId = (int) substr($chaine_temp_reward, 0, strpos($chaine_temp_reward, '&'));
	
		$optionsIdsString = "";
		if (strpos($custom, 'opt=') !== false) $optionsIdsString = substr($custom, strpos($custom, 'opt=') + strlen('opt='), strlen($custom) - (strpos($custom, 'opt=') + strlen('opt=')));

		$logger->info("userId : ".$userId);	
		$logger->info("rewardId : ".$rewardId);	
		$logger->info("optionsIdsString : ".$optionsIdsString);	
		
		$optionsIds = array();
		
		while ($optionsIdsString)
		{
			$optionsIds[] = (int) substr($optionsIdsString, 0, 1);
			$optionsIdsString = substr($optionsIdsString, 2, strlen($optionsIdsString));
		}
		
		//Création de la transaction
		$transaction = new Transaction($this->container->getParameter('witty.paypal.fees'));
		$transaction->setPaypalId($request->get('txn_id'));
		
		$user = $em->getRepository('WittyUserBundle:User')->find($userId);
		$reward = $em->getRepository('WittyProjectBundle:Reward')->find($rewardId);
		
			//Ajout du user
		$transaction->setUser($user);
		
			//Ajout des rewards
		$transaction->addReward($reward);

			//Ajout des options
		if (!empty($optionsIds)) 
		{
			foreach($em->getRepository('WittyProjectBundle:RewardOption')->findBy(array('id' => $optionsIds)) as $option)
				$transaction->addOption($option);
		}
		
			//Ajout des rewards et options annulés par la transaction. Pour l'instant sont annulés tous les rewards et options du même projet
		foreach($transaction->getUser()->getUserRewardsByProjectId($reward->getProject()->getId()) as $cancelledReward)
			$transaction->addCancelledUserReward($cancelledReward);
			
		foreach($transaction->getUser()->getUserRewardOptionsByProjectId($reward->getProject()->getId()) as $cancelledOption)
			$transaction->addCancelledUserRewardOption($cancelledOption);

		$logger->info("Transaction créée");	
		
		return $transaction;
	}
	
	
	
	//Procède aux vérifications avant de créer une transaction
	private function verifierTransaction(Transaction $transaction, $logger, $request)
	{		
		$em = $this->getDoctrine()->getEntityManager();
	
		//Vérification transaction déjà reçue ?
		if ( $request->get('txn_id') && ($em->getRepository('WittyTransactionBundle:Transaction')->findByPaypalId($transaction->getPaypalId())) ) //Si la transaction vient de Paypal, la différence entre le montant envoyé par Paypal et celui que l'on a recalculé sur la base des rewards et des options dépasse les erreurs d'arrondi
		{
			$logger->err('Transaction déjà reçue -> id: '.$transaction->getPaypalId());
			$logger->info("Transaction KO");	
			
			throw new \Exception("Erreur: transaction déjà reçue");
		}
	
		//Vérification des montants
		if ( $request->get('txn_id') && !(abs($transaction->getTotalAmount() - $request->get('mc_gross')) <= 0.05)) //Si la différence entre le montant envoyé par Paypal et celui que l'on a recalculé sur la base des rewards et des options dépasse les erreurs d'arrondi
		{
			$logger->err("Montant Paypal incorrect -> Montant de la transaction :".$transaction->getTotalAmount().", Montant envoyé par Paypal:".$request->get('mc_gross'));
			$logger->info("Transaction KO");
			
			throw new \Exception("Erreur de montant paypal");
		}
	
		return true;
	}
	
	
	//Effectue les traitements postTransaction
	private function processPostTransaction(Transaction $transaction, $logger)
	{
		$em = $this->getDoctrine()->getEntityManager();

		$logger->info("Crédit avant annulation des rewards: ".$transaction->getUser()->getCredit());

		//Annulation des anciens Rewards du User (le crédit est mis à jour)
		$transaction->getUser()->cancelUserRewards($transaction->getCancelledUserRewards());
		$transaction->getUser()->cancelUserRewardOptions($transaction->getCancelledUserRewardOptions());

		$logger->info("Rewards et options annulés, nouveau crédit: ".$transaction->getUser()->getCredit());
		
		//Ajout de la somme payée par l'user à son crédit
		$transaction->getUser()->addToCredit($transaction->getAmount());
		
		$logger->info("Ajout de la somme payée à paypal, nouveau crédit: ".$transaction->getUser()->getCredit());
		
		//Ajout des rewards et options achetés au User
		$userReward = new UserReward();
		$userReward->setUser($transaction->getUser());
		$userReward->setReward($transaction->getRewards()->first());
		$transaction->getUser()->addUserReward($userReward);

		$logger->info("Reward ajouté");

		foreach($transaction->getOptions() as $option)
			$transaction->getUser()->addUserRewardOption($userReward->getReward(), $option);

		$logger->info("Options ajoutées");
		$logger->info("Crédit de fin: ".$transaction->getUser()->getCredit());

		$em->persist($transaction->getUser());
		$em->flush();
		
		$logger->info("Affectation de ses achats au User OK. Transaction terminée avec succès.");
	}
	
	
    /**
     * @Route("/cancel", name="transaction_cancel")
     */
    public function cancelAction()
    {
		return new \Symfony\Component\HttpFoundation\Response('annulation');
	}		
	
    /**
     * @Route("/return", name="transaction_return")
     */
    public function returnAction()
    {
		return new \Symfony\Component\HttpFoundation\Response('retour');
	}
	
    /**
     * @Route("/annuler_contrepartie/{userRewardId}", requirements={"id" = "\d+"}, name="annuler_contrepartie")
     */	
	public function cancelUserReward($userRewardId)
	{
		$em = $this->getDoctrine()->getEntityManager();
	
		$transaction = new Transaction($this->container->getParameter('witty.paypal.fees'));
		$userReward = $em->getRepository("WittyProjectBundle:UserReward")->find($userRewardId);
		$transaction->setUser($this->getUser());
		
		$transaction->addCancelledUserReward($userReward);
		foreach($transaction->getUser()->getUserRewardOptionsByRewardId($userReward->getReward()->getId()) as $cancelledOption)
			$transaction->addCancelledUserRewardOption($cancelledOption);

		$transaction->getUser()->cancelUserRewards($transaction->getCancelledUserRewards());
		$transaction->getUser()->cancelUserRewardOptions($transaction->getCancelledUserRewardOptions());
		
		$em->persist($transaction);
		$em->persist($transaction->getUser());
		$em->flush();
		
		return $this->redirect($this->generateUrl('fos_user_profile_edit'));
	}
}
