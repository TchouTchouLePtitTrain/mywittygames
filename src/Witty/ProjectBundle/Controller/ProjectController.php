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
		return $this->displayProjectsList();
    }
	
	//L'argument "slug" peut être un slug ou un id
    public function displayAction($slug)
    {
		$em = $this->getDoctrine()->getEntityManager();
		
		if (gettype($slug) == 'string')
			$project = $em->getRepository('WittyProjectBundle:Project')->findOneBySlug($slug);
		elseif (gettype($slug) == 'integer')
			$project = $em->getRepository('WittyProjectBundle:Project')->findOneById($slug);

		return $this->render('WittyProjectBundle:Project:project.html.twig', 
			array(
				'project' => $project
			));
    }
	
    public function displayProjectsList()
    {
		$em = $this->getDoctrine()->getEntityManager();
		
		$projects = $em->getRepository('WittyProjectBundle:Project')->findAll();
			
		return $this->render('WittyProjectBundle:Project:projects_list.html.twig', array('projects' => $projects));
    }
}
