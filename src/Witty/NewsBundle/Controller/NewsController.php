<?php

namespace Witty\NewsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class NewsController extends Controller
{
    /**
     * @Route("/news", name="news_mashup")
     * @Template("WittyNewsBundle:Mashup:mashup.html.twig")
     */
    public function mashupAction()
    {
        return array();
    }
	
    /**
     * @Route("/news/liste-articles", name="news_mashup_liste_articles")
     * @Template("WittyNewsBundle:Mashup:listeArticles.html.twig")
     */
    public function listeArticlesAction()
    {
        return array();
    }
}
