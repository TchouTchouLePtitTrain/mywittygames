<?php

namespace Witty\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Witty\BlogBundle\Entity\Post
 *
 * @ORM\Table(name="post")
 * @ORM\Entity(repositoryClass="Witty\BlogBundle\Repository\PostRepository")
 */
class Post
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
	
    /**
     * @ORM\OneToMany(targetEntity="Comment", mappedBy="post")
     */
    protected $comments;
	
    /**
     * @var \DateTime $creationDate
     *
     * @ORM\Column(name="creationDate", type="datetime")
     */
    private $creationDate;

    /**
     * @var string $title
     *
     * @ORM\Column(name="title", type="string")
     */
    private $title;
	
    /**
     * @var string $content
     *
     * @ORM\Column(name="content", type="text")
     */
    private $content;


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
     * @return Post
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
     * @return Post
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
     * Constructor
     */
    public function __construct()
    {
        $this->comments = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add comments
     *
     * @param Witty\BlogBundle\Entity\Comment $comments
     * @return Post
     */
    public function addComment(\Witty\BlogBundle\Entity\Comment $comments)
    {
        $this->comments[] = $comments;
    
        return $this;
    }

    /**
     * Remove comments
     *
     * @param Witty\BlogBundle\Entity\Comment $comments
     */
    public function removeComment(\Witty\BlogBundle\Entity\Comment $comments)
    {
        $this->comments->removeElement($comments);
    }

    /**
     * Get comments
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Post
     */
    public function setTitle($title)
    {
        $this->title = $title;
    
        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
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