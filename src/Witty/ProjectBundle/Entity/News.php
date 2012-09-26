<?php

namespace Witty\ProjectBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Witty\ProjectBundle\Entity\News
 *
 * @ORM\Table(name="project_news")
 * @ORM\Entity
 */
class News
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
	 * @ORM\ManyToOne(targetEntity="Project", inversedBy="news")
     * @ORM\JoinColumn(name="project_id", referencedColumnName="id")
     */
    private $project;
	
    /**
     * @var \DateTime $createdAt
     */
    private $createdAt;

    /**
     * @var \DateTime $updatedAt
     */
    private $updatedAt;	
	
    /**
     * @var integer $title
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=false)
     */
    private $title;

    /**
     * @var integer $content
     *
     * @ORM\Column(name="content", type="text", nullable=true)
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
     * Set title
     *
     * @param string $title
     * @return News
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

    /**
     * Set content
     *
     * @param string $content
     * @return News
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
     * @return News
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
}