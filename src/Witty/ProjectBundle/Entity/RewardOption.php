<?php

namespace Witty\ProjectBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Witty\ProjectBundle\Entity\RewardOption
 *
 * @ORM\Table(name="reward_option")
 * @ORM\Entity
 */
class RewardOption
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
     * @ORM\ManyToMany(targetEntity="Reward", mappedBy="options")
     */
    private $rewards;

    /**
     * @var integer $cost
     *
     * @ORM\Column(name="cost", type="integer", nullable=true)
     */
    private $cost;

    /**
     * @var string $title
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=false)
     */
    private $title;
	
    /**
     * @var string $description
     *
     * @ORM\Column(name="description", type="string", length=510, nullable=true)
     */
    private $description;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->rewards = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set cost
     *
     * @param integer $cost
     * @return RewardOption
     */
    public function setCost($cost)
    {
        $this->cost = $cost;
    
        return $this;
    }

    /**
     * Get cost
     *
     * @return integer 
     */
    public function getCost()
    {
        return $this->cost;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return RewardOption
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
     * Set description
     *
     * @param string $description
     * @return RewardOption
     */
    public function setDescription($description)
    {
        $this->description = $description;
    
        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Add rewards
     *
     * @param Witty\ProjectBundle\Entity\Reward $rewards
     * @return RewardOption
     */
    public function addReward(\Witty\ProjectBundle\Entity\Reward $rewards)
    {
        $this->rewards[] = $rewards;
    
        return $this;
    }

    /**
     * Remove rewards
     *
     * @param Witty\ProjectBundle\Entity\Reward $rewards
     */
    public function removeReward(\Witty\ProjectBundle\Entity\Reward $rewards)
    {
        $this->rewards->removeElement($rewards);
    }

    /**
     * Get rewards
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getRewards()
    {
        return $this->rewards;
    }
}