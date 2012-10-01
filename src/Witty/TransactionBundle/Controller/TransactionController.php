<?php

namespace Witty\TransactionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use JMS\SecurityExtraBundle\Annotation\Secure;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class TransactionController extends Controller
{

    /**
     * @Route("/confirmation", name="transaction_confirmation")
	 * @Secure(roles="ROLE_USER")
     * @Template
     */
    public function transactionAction()
    {
		$request = $this->getRequest();
		
		if (!$request->getMethod() == 'POST')
			throw new \Exception('Erreur');

		//Initiation de la transaction
		$this->beginTransaction($request);
		
		//Redirection sur Paypal
		
		
        return array();
    }

	
	//Initie la transaction du User
    public function beginTransaction($request)
    {
		$rewardId = $request->get('reward_id');
		$optionsIds = $request->get('options');print_r($options);die('ok');
		
		//Récupération des rewards et options
		$em = $this->getDoctrine()->getEntityManager();
		$reward = $em->getRepository('WittyProjectBundle:Reward')->findOneById($rewardId);
		$options = $em->getRepository('WittyProjectBundle:Reward')->findBy(array('id' => $optionsIds));
		
		//Création d'une transaction
		$transaction = new Transaction($this->container->getParameter('witty.paypal.fees'));
		
		//Ajout des rewards
		$transaction->addReward($reward);
		
		//Ajout des options
		foreach($options as $option)
			$transaction->addReward($option);
		
		//Persist de la transaction
		$em->persist($transaction);
		$em->flush();
    }
	
	
    /**
     * @Route("/transaction_completion")
	 * @Secure(roles="ROLE_USER")
     */
    public function transactionCompletionAction()
    {
	
    }	
	
	
    /**
     * @Route("/success", name="transaction_success")
     */
    public function successAction()
    {
		$logger = new Logger('paypalSuccessLogger');
		$logger->pushHandler(new StreamHandler($this->container->getParameter('witty.paypal.log.success.path'), Logger::INFO));

		$logger->info('IPN reçu le '.date('d/m/y à G:i:s'));
		
		//Traitement de l'IPN
		$request = $this->getRequest();
		
		if (!$request->getMethod() == 'POST')
			throw new \Exception('Erreur');
			
		$custom = $request->get('custom');
		
		$logger->info($custom);
		
		
		return new \Symfony\Component\HttpFoundation\Response('ok');
	}
	
}
