<?php

namespace Witty\ShareBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Witty\ShareBundle\Entity\Share
 */
class Share
{
    /**
     * @var integer $id
     */
    private $id;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    private $user;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    private $game;

    /**
     * @var \DateTime $createdAt
     */
    private $createdAt;

    /**
     * @var \DateTime $updatedAt
     */
    private $updatedAt;

    /**
     * @var boolean $isCancelled
     */
    private $isCancelled;


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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Share
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    
        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return Share
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
    
        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime 
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set isCancelled
     *
     * @param boolean $isCancelled
     * @return Share
     */
    public function setIsCancelled($isCancelled)
    {
        $this->isCancelled = $isCancelled;
    
        return $this;
    }

    /**
     * Get isCancelled
     *
     * @return boolean 
     */
    public function getIsCancelled()
    {
        return $this->isCancelled;
    }


    /**
     * Set user
     *
     * @param Witty\UserBundle\Entity\User $user
     * @return Share
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
     * Set game
     *
     * @param Witty\ShareBundle\Entity\Game $game
     * @return Share
     */
    public function setGame(\Witty\ShareBundle\Entity\Game $game = null)
    {
        $this->game = $game;
    
        return $this;
    }

    /**
     * Get game
     *
     * @return Witty\ShareBundle\Entity\Game 
     */
    public function getGame()
    {
        return $this->game;
    }
}