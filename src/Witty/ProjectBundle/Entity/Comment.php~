<?php

namespace Witty\ProjectBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Witty\ProjectBundle\Entity\Comment
 *
 * @ORM\Table(name="project_comments")
 * @ORM\Entity
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
	 * @ORM\ManyToOne(targetEntity="Project", inversedBy="comments")
     * @ORM\JoinColumn(name="project_id", referencedColumnName="id")
     */
    private $project;
	
    /**
	 * @ORM\ManyToOne(targetEntity="\Witty\UserBundle\Entity\User", inversedBy="comments")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;
	
    /**
     * @var \DateTime $creationDate
     *
     * @ORM\Column(name="creation_date", type="datetime", nullable=false)
     */
	private $creationDate;

    /**
     * @var integer $content
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
     * Set project
     *
     * @param Witty\ProjectBundle\Entity\Project $project
     * @return Comment
     */
    public function setProject(\Witty\ProjectBundle\Entity\Project $project = null)
    {
        $this->project = $project;
    
        return $this;
    }

    /**
     * Get project
     *
     * @return Witty\ProjectBundle\Entity\Project 
     */
    public function getProject()
    {
        return $this->project;
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
	
	//Renvoie une string : le délai entre maintenant et le moment où le commentaire a été posté
	public function getDelay()
	{
		$delai = $this->getCreationDate()->diff(new \DateTime());
		
		if ($delai->y !== 0) return $delai->format('%y an'.(($delai->y > 1)? 's' : ''));
		elseif ($delai->m !== 0) return $delai->format('%m moi'.(($delai->m > 1)? 's' : ''));
		elseif ($delai->d !== 0) return $delai->format('%d jour'.(($delai->d > 1)? 's' : ''));
		elseif ($delai->h !== 0) return $delai->format('%h heure'.(($delai->h > 1)? 's' : ''));
		else return $delai->format('%i minute'.(($delai->m > 1)? 's' : ''));
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
}