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
    public function indexAction($name = null)
    {
		if ($name) //SI un projet en particulier est demandé
			return $this->render('WittyProjectBundle:Project:project.html.twig', array());
		else //Sinon la liste des projets est retournée
			return $this->listProjectsAction();
    }
	
    public function listProjectsAction()
    {
        return $this->render('WittyProjectBundle:Project:list_projects.html.twig', array());
    }
}
