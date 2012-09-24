<?php

namespace Witty\MwgBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class HomeController extends Controller
{
    /**
     * @Template()
     */
    public function indexAction()
    {
	/*
$message = \Swift_Message::newInstance()
        ->setSubject('Hello Email')
        ->setFrom('send@example.com')
        ->setTo('TchouTchouLePtitTrain@gmail.com')
        ->setBody('ok')
    ;
    $this->get('mailer')->send($message);
	*/
        return $this->render('WittyMwgBundle:Home:index.html.twig', array());
    }
}
