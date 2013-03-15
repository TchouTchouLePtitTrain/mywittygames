<?php

namespace Witty\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Witty\BlogBundle\Entity\Comment;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/blog")
 */
class BlogController extends Controller
{
    /**
     * @Route("", name="blog")
     * @Template()
     */
    public function blogAction()
    {
		$em = $this->getDoctrine()->getEntityManager();
		$posts = $em->getRepository('WittyBlogBundle:Post')->findAllOrderedByCreationDate();
	
		return array('posts' => $posts);
    }
	
    /**
     * @Route("/post/{postId}", requirements={"postId" = "\d+"}, name="blog_post")
     * 
     */
    public function getPostAction($postId = null)
    {
		$em = $this->getDoctrine()->getEntityManager();

		if ($postId === null)
			$post = $em->getRepository('WittyBlogBundle:Post')->findLastPost();
		else
			$post = $em->getRepository('WittyBlogBundle:Post')->find($postId);

		return $this->render('WittyBlogBundle:Blog:post.html.twig', 
					array(
						'post' => $post
					)
				);
    }
	
    /**
     * @Route("/post/scroll_loading", name="blog_post_number")
     * 
     */
    public function getPostByNumberAction()
    {

		$em = $this->getDoctrine()->getEntityManager();
		
		$request = Request::createFromGlobals();
		$number = $request->request->get('load_number');

		$nombre_de_posts = (int) $em->getRepository('WittyBlogBundle:Post')->countAll();

		if ($number > $nombre_de_posts)
			return new Response('end');
		else
		{
			$post = $em->getRepository('WittyBlogBundle:Post')->findByNumber($number);
			return $this->render('WittyBlogBundle:Blog:post.html.twig', 
						array(
							'post' => $post
						)
					);
		}
    }

	
	/**
     * @Route("/ajouter-commentaire", name="blog_addComment")
	 * Ajoute le commentaire passé en POST au post
     */
    public function addCommentAction()
    {
		$request = $this->get('request');	

		if ($request->getMethod() === 'POST')
		{
			$em = $this->getDoctrine()->getEntityManager();
			
			$post = $em->getRepository('WittyBlogBundle:Post')->find($request->request->get('postId'));

			$comment = new Comment();
			$comment->setPost($post);
			$comment->setUser($this->getUser());
			$comment->setContent($request->request->get('content')); //Pour que les sauts de lignes soient visibles à l'affichage, il faut convertir les "new line" en balises <br/>
			
			if ($this->container->get('validator')->validate($comment))
			{
				$post->addComment($comment);
				$this->getUser()->addPostComment($comment);
			
				//Ajout du commentaire
				$em->persist($comment);
				$em->persist($post);
				$em->persist($this->getUser());
				$em->flush();
			
				return $this->blocCommentsAction($post->getId());
			}
			else throw new \Exception("Erreur d'ajout du commentaire");
		}
		else throw new \Exception("Vous ne pouvez pas ajouter ce commentaire");
    }
	
	/**
     * @Route("/commentaires-projet/{postId}", name="blog_blocComments")
	 * Affiche le bloc des commentaires
     */	
    public function blocCommentsAction($postId)
    {
		$em = $this->getDoctrine()->getEntityManager();
		$comments = $em->getRepository('WittyBlogBundle:Comment')->findAllOrderedByCreationDate($postId);

		return $this->render('WittyBlogBundle:Blog:blocComments.html.twig', array(
						'comments' => $comments
					)
				);
    }
}
