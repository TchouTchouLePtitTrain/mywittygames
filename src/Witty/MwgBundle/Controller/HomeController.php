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
        return $this->render('WittyMwgBundle:Home:index.html.twig', array());
    }
}
