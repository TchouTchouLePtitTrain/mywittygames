<?php

namespace Witty\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Witty\BlogBundle\Entity\Comment
 *
 * @ORM\Table(name="post_comment")
 * @ORM\Entity(repositoryClass="Witty\BlogBundle\Entity\CommentRepository")
 */
class Comment
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;
	
    /**
	 * @ORM\ManyToOne(targetEntity="Post", inversedBy="comments")
     * @ORM\JoinColumn(name="post_id", referencedColumnName="id")
     */
    private $post;
	
    /**
	 * @ORM\ManyToOne(targetEntity="\Witty\UserBundle\Entity\User", inversedBy="postComments")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;
	
    /**
     * @var \DateTime $creationDate
     *
     * @ORM\Column(name="creationDate", type="datetime", nullable=false)
     */
    private $creationDate;

    /**
     * @var string $content
     *
     * @ORM\Column(name="content", type="text", nullable=true)
     */
    private $content;

	public function __construct()
	{
		$this->creationDate = new \Datetime();
	}
	
    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set creationDate
     *
     * @param \DateTime $creationDate
     * @return Comment
     */
    public function setCreationDate($creationDate)
    {
        $this->creationDate = $creationDate;
    
        return $this;
    }

    /**
     * Get creationDate
     *
     * @return \DateTime 
     */
    public function getCreationDate()
    {
        return $this->creationDate;
    }

    /**
     * Set content
     *
     * @param string $content
     * @return Comment
     */
    public function setContent($content)
    {
        $this->content = $content;
    
        return $this;
    }

    /**
     * Get content
     *
     * @return string 
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set blog
     *
     * @param Witty\BlogBundle\Entity\Blog $blog
     * @return Comment
     */
    public function setBlog(\Witty\BlogBundle\Entity\Blog $blog = null)
    {
        $this->blog = $blog;
    
        return $this;
    }

    /**
     * Get blog
     *
     * @return Witty\BlogBundle\Entity\Blog 
     */
    public function getBlog()
    {
        return $this->blog;
    }

    /**
     * Set user
     *
     * @param Witty\UserBundle\Entity\User $user
     * @return Comment
     */
    public function setUser(\Witty\UserBundle\Entity\User $user = null)
    {
        $this->user = $user;
    
        return $this;
    }

    /**
     * Get user
     *
     * @return Witty\UserBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set post
     *
     * @param Witty\BlogBundle\Entity\Post $post
     * @return Comment
     */
    public function setPost(\Witty\BlogBundle\Entity\Post $post = null)
    {
        $this->post = $post;
    
        return $this;
    }

    /**
     * Get post
     *
     * @return Witty\BlogBundle\Entity\Post 
     */
    public function getPost()
    {
        return $this->post;
    }
		
	//Renvoie une string : le délai entre maintenant et le moment où le commentaire a été posté
	public function getDelay()
	{
		$delai = $this->getCreationDate()->diff(new \DateTime());

		if ($delai->y !== 0) return $delai->format('%y an'.(($delai->y > 1)? 's' : ''));
		elseif ($delai->m !== 0) return $delai->format('%m mois');
		elseif ($delai->d !== 0) return $delai->format('%d jour'.(($delai->d > 1)? 's' : ''));
		elseif ($delai->h !== 0) return $delai->format('%h heure'.(($delai->h > 1)? 's' : ''));
		else return $delai->format('%i minute'.(($delai->i > 1)? 's' : ''));
	}
}