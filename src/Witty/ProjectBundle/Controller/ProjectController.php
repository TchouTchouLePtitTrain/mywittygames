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
	
    public function displayAction($project_id)
    {
		$em = $this->getDoctrine()->getEntityManager();
		
		$project = $em->getRepository('WittyProjectBundle:Project')->findOneById($project_id);
		$edinautes = $em->getRepository('WittyUserBundle:User')->findEdinautesByProjectId($project_id);

		return $this->render('WittyProjectBundle:Project:project.html.twig', 
			array(
				'project' => $project, 
				'edinautes' => $edinautes
			));
    }
}
