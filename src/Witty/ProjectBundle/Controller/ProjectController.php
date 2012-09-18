<?php

namespace Witty\ProjectBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class ProjectController extends Controller
{
    /**
     * @Template()
     */
    public function indexAction()
    {
		return $this->render('WittyProjectBundle:Project:list_projects.html.twig', array());
    }
	
    public function displayAction($name)
    {
		return $this->render('WittyProjectBundle:Project:project.html.twig', array());
    }
}
