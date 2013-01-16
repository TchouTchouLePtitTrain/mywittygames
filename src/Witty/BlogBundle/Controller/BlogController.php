<?php

namespace Witty\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class BlogController extends Controller
{
    /**
     * @Route("blog", name="blog")
     * @Template()
     */
    public function blogAction()
    {
		$em = $this->getDoctrine()->getEntityManager();
		$posts = $em->getRepository('WittyBlogBundle:Post')->findAllOrderedByCreationDate();
	
		return array('posts' => $posts);
    }
}
