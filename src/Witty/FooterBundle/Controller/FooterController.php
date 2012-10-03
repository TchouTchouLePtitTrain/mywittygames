<?php

namespace Witty\FooterBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class FooterController extends Controller
{
    /**
     * @Template()
     */
    public function displayAction()
    {
        return array();
    }
}
