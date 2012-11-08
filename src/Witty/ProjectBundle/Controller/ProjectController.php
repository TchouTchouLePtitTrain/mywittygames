<?php

namespace Witty\ProjectBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use JMS\SecurityExtraBundle\Annotation\Secure;
use Witty\ProjectBundle\Entity\Comment;

class ProjectController extends Controller
{
    /**
     * @Template()
     */
    public function indexAction($mode_affichage = 'focus_one_project')
    {
		$em = $this->getDoctrine()->getEntityManager();
		$members_count = $em->getRepository('WittyUserBundle:User')->getMembersNumber();
	
		return $this->render('WittyProjectBundle:Project:projects.html.twig', 
			array(
				'mode_affichage' => $this->container->getParameter('witty.design.project.list.mode_affichage'),
				'members_count' => $members_count
			)
		);
    }
	
	//L'argument "slug" peut être un slug ou un id
    public function displayAction($slug)
    {
		$em = $this->getDoctrine()->getEntityManager();
		
		//Compatibilité saison 1 et 2
		/*$jeux_saison_1_et_2 = array( "pong", "zibi", "chronos", "ice3", "temple", "jeu-du-métro", "empathy" );
		
		if (in_array($slug, $jeux_saison_1_et_2) )
		{
			$game = $em->getRepository('WittyShareBundle:Game')->findOneBySlug($slug);
			$edinautes = $em->getRepository('WittyUserBundle:User')->findEdinautesByGameId($game->getId());
		
			return $this->render('WittyProjectBundle:Project:game_saison_1_et_2.html.twig', 
				array(
					'game' => $game, 
					'edinautes' => $edinautes
				));
		}*/
		//Fin compatibilité
		
		
		if (!is_numeric($slug) == 'string')
			$project = $em->getRepository('WittyProjectBundle:Project')->findOneBySlug($slug);
		else
			$project = $em->getRepository('WittyProjectBundle:Project')->findOneById($slug);

		$edinautes = array();
		foreach($project->getEdinautes() as $id)
		{
			$edinautes[] = $em->getRepository('WittyUserBundle:User')->find($id);
		}

		return $this->render('WittyProjectBundle:Project:project.html.twig', 
			array(
				'project' => $project, 
				'edinautes' => $edinautes
			));
    }
	
    public function projectsListAction($mode_affichage = 'focus_one_project')
    {
		$em = $this->getDoctrine()->getEntityManager();
		$projectsFunded = $em->getRepository('WittyProjectBundle:Project')->findFundedOrderedByPriority();
		$projectsNotFunded = $em->getRepository('WittyProjectBundle:Project')->findNotFundedOrderedByPriority();
		
		return $this->render('WittyProjectBundle:Project:projects_list.html.twig', array('projectsFunded' => $projectsFunded, 'projectsNotFunded' => $projectsNotFunded, 'mode_affichage' => $mode_affichage));
    }
	
	/**
     * @Secure(roles="ROLE_USER")
     */
    public function confirmationAction($id)
    {
		$em = $this->getDoctrine()->getEntityManager();
		$reward = $em->getRepository('WittyProjectBundle:Reward')->findOneById($id);
		
		return $this->render('WittyProjectBundle:Project:confirmation.html.twig', array(
					'reward' => $reward
					)
				);
    }	
	
    public function blocRewardsAction($project, $linking, $rewardId = null)
    {
		$parametres = array(
						'project' => $project, 
						'linking' => $linking, 
						'rewardId' => $rewardId
					);

		if ($rewardId) $parametres['rewardId'] = $rewardId;
	
		return $this->render('WittyProjectBundle:Project:blocRewards.html.twig', $parametres);
    }
	
    public function blocRecapRewardAction($rewardId)
    {
		$reward = $this->getDoctrine()->getEntityManager()->getRepository("WittyProjectBundle:Reward")->find($rewardId);

		return $this->render('WittyProjectBundle:Project:blocRecapReward.html.twig', array(
						'reward' => $reward
					)
				);
    }
	
	//Ajoute le commentaire passé en POST au projet
    public function addCommentAction()
    {
		$request = $this->get('request');	

		if ($request->getMethod() === 'POST')
		{
			$em = $this->getDoctrine()->getEntityManager();
			
			$project = $em->getRepository('WittyProjectBundle:Project')->find($request->request->get('projectId'));

			$comment = new Comment();
			$comment->setProject($project);
			$comment->setUser($this->getUser());
			$comment->setContent($request->request->get('content')); //Pour que les sauts de lignes soient visibles à l'affichage, il faut convertir les "new line" en balises <br/>
			
			if ($this->container->get('validator')->validate($comment))
			{
				$project->addComment($comment);
				$this->getUser()->addProjectComment($comment);
			
				//Ajout du commentaire
				$em->persist($comment);
				$em->persist($project);
				$em->persist($this->getUser());
				$em->flush();
			
				return $this->blocCommentsAction($project->getId());
			}
			else throw new \Exception("Erreur d'ajout du commentaire");
		}
		else throw new \Exception("Vous ne pouvez pas ajout ce commentaire");
    }
	
    public function blocCommentsAction($projectId)
    {
		$em = $this->getDoctrine()->getEntityManager();
		$comments = $em->getRepository('WittyProjectBundle:Comment')->findAllOrderedByCreationDate($projectId);

		return $this->render('WittyProjectBundle:Project:blocComments.html.twig', array(
						'comments' => $comments
					)
				);
    }
}
