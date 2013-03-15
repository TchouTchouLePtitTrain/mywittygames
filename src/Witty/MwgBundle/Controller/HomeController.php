<?php

namespace Witty\MwgBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

class HomeController extends Controller
{
    /**
     * @Template()
     */
    public function indexAction()
    {
		$em = $this->getDoctrine()->getEntityManager();
		$members_count = $em->getRepository('WittyUserBundle:User')->getMembersNumber();

        return $this->render('WittyMwgBundle:Home:index.html.twig', 
			array(
				'mode_affichage' => $this->container->getParameter('witty.design.home.mode_affichage'),
				'members_count' => $members_count
			)
		);
    }
    
    /**
     * @Template()
     */
    public function faqAction()
    {
        return $this->render('WittyMwgBundle:Home:faq.html.twig');
    }  
	
    /**
     * @Template()
     */
    public function cguAction()
    {
        return $this->render('WittyMwgBundle:Home:cgu.html.twig');
    }   
	
    /**
     * @Template()
     */
    public function cguEdinautesAction()
    {
        return $this->render('WittyMwgBundle:Home:cgu_edinautes.html.twig');
    }
	
    /**
     * @Template()
     */
    public function mentionsLegalesAction()
    {
        return $this->render('WittyMwgBundle:Home:mentions_legales.html.twig');
    }	
	
    /**
     * @Template()
     */
    public function presseAction()
    {
        return $this->render('WittyMwgBundle:Home:presse.html.twig');
    }
	
    /**
     * @Template()
     */
    public function partenairesAction()
    {
		$url_amazon_ice3 = $this->container->getParameter('witty.distribution.amazon.ice3');
		$url_fnac_ice3 = $this->container->getParameter('witty.distribution.fnac.ice3');
		$url_joueclub_ice3 = $this->container->getParameter('witty.distribution.joue_club.ice3');
		
        return array(
			'url_amazon_ice3' => $url_amazon_ice3,
			'url_fnac_ice3' => $url_fnac_ice3,
			'url_joueclub_ice3' => $url_joueclub_ice3
		);
    }
	
	
	
	//Méthode pour les anciennes urls
	public function urlHistoriquesAction($url)
	{
		//Jeux
		if ( ($url == 'game/view/2') || (stripos($url, 'pong') !== false) ) return $this->redirect($this->generateUrl('project_display', array('slug' => 'pong')), 301);
		if ( ($url == 'game/view/3') || (stripos($url, 'zibi') !== false) ) return $this->redirect($this->generateUrl('project_display', array('slug' => 'zibi')), 301);
		if ( ($url == 'game/view/6') || (stripos($url, 'chronos') !== false) ) return $this->redirect($this->generateUrl('project_display', array('slug' => 'chronos')), 301);
		if ( ($url == 'game/view/8') || (stripos($url, 'ice') !== false) ) return $this->redirect($this->generateUrl('project_display', array('slug' => 'ice3')), 301);
		if ( ($url == 'game/view/11') || (stripos($url, 'temple') !== false) ) return $this->redirect($this->generateUrl('project_display', array('slug' => 'temple')), 301);
		if ( ($url == 'game/view/45') || (stripos($url, 'metro') !== false) ) return $this->redirect($this->generateUrl('project_display', array('slug' => 'jeu-du-métro')), 301);
		if ( ($url == 'game/view/48') || (stripos($url, 'empathy') !== false) ) return $this->redirect($this->generateUrl('project_display', array('slug' => 'empathy')), 301);
		
		if (stripos($url,'game') !== false) return $this->redirect($this->generateUrl('project_accueil'), 301);
		
		//Presse
		if (stripos($url, 'press') !== false) return $this->redirect($this->generateUrl('mwg_presse'), 301);
		
		return $this->redirect($this->generateUrl('mwg_accueil'), 301);
	}
	    
	/**
     * @Route("/scroll_loading", name="blog_post")
     * @Template()
     */
	public function scroll_loading()
	{
		$request = Request::createFromGlobals();
		$load_number = $request->request->get('load_number');
		
		return BlogController::getPostByNumberAction($load_number);
	}
	
}
