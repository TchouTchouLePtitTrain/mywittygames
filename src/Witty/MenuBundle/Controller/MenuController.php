<?php

namespace Witty\MenuBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class MenuController extends Controller
{
    /**
     * @Template()
     */
    public function displayAction()
    {
        return $this->render('WittyMenuBundle:Menu:index.html.twig', array());
    }
}
