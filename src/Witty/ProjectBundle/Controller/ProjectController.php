<?php

namespace Witty\ProjectBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use JMS\SecurityExtraBundle\Annotation\Secure;

class ProjectController extends Controller
{
    /**
     * @Template()
     */
    public function indexAction($mode_affichage = 'focus_one_project')
    {
		return $this->render('WittyProjectBundle:Project:projects.html.twig', 
			array(
				'mode_affichage' => $this->container->getParameter('witty.design.project.list.mode_affichage')
			)
		);
    }
	
	//L'argument "slug" peut être un slug ou un id
    public function displayAction($slug)
    {
		$em = $this->getDoctrine()->getEntityManager();
		
		if (!is_numeric($slug) == 'string')
			$project = $em->getRepository('WittyProjectBundle:Project')->findOneBySlug($slug);
		else
			$project = $em->getRepository('WittyProjectBundle:Project')->findOneById($slug);

		return $this->render('WittyProjectBundle:Project:project.html.twig', 
			array(
				'project' => $project
			));
    }
	
    public function projectsListAction($mode_affichage = 'focus_one_project')
    {
		$em = $this->getDoctrine()->getEntityManager();
		$projects = $em->getRepository('WittyProjectBundle:Project')->findAllOrderedByPriority();
			
		return $this->render('WittyProjectBundle:Project:projects_list.html.twig', array('projects' => $projects, 'mode_affichage' => $mode_affichage));
    }	
	
	/**
     * @Secure(roles="ROLE_USER")
     */
    public function confirmationAction($id)
    {
		$em = $this->getDoctrine()->getEntityManager();
		$reward = $em->getRepository('WittyProjectBundle:Reward')->findOneById($id);
	
		return $this->render('WittyProjectBundle:Project:confirmation.html.twig', array(
					'reward' => $reward, 
					'paypal_fees' => (float) $this->container->getParameter('witty.paypal.fees'), 
					'email_businees' => $this->container->getParameter('witty.paypal.email_business')
					)
				);
    }
}
