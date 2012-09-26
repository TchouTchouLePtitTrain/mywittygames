<?php

namespace Witty\ProjectBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Witty\ProjectBundle\Entity\UserReward
 *
 * @ORM\Table(name="user_reward")
 * @ORM\Entity
 */
class UserReward
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
	 * @ORM\ManyToOne(targetEntity="Witty\UserBundle\Entity\User", inversedBy="userRewards")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    /**
	 * @ORM\ManyToOne(targetEntity="Reward", inversedBy="userRewards")
     * @ORM\JoinColumn(name="reward_id", referencedColumnName="id")
     */
    private $reward;

    /**
     * @var boolean $cancelled
     *
     * @ORM\Column(name="cancelled", type="boolean", nullable=false)
     */
    private $cancelled;

    /**
     * @var \DateTime $creationDate
     *
     * @ORM\Column(name="creation_date", type="datetime", nullable=false)
     */
    private $creationDate;

    /**
     * @var \DateTime $updateDate
     *
     * @ORM\Column(name="update_date", type="datetime", nullable=true)
     */
    private $updateDate;
	
    /**
     * @var integer $paidAmount
     *
     * @ORM\Column(name="paid_amount", type="integer")
     */
    private $paidAmount;



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
     * Set cancelled
     *
     * @param boolean $cancelled
     * @return UserReward
     */
    public function setCancelled($cancelled)
    {
        $this->cancelled = $cancelled;
    
        return $this;
    }

    /**
     * Get cancelled
     *
     * @return boolean 
     */
    public function getCancelled()
    {
        return $this->cancelled;
    }

    /**
     * Set creationDate
     *
     * @param \DateTime $creationDate
     * @return UserReward
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
     * Set updateDate
     *
     * @param \DateTime $updateDate
     * @return UserReward
     */
    public function setUpdateDate($updateDate)
    {
        $this->updateDate = $updateDate;
    
        return $this;
    }

    /**
     * Get updateDate
     *
     * @return \DateTime 
     */
    public function getUpdateDate()
    {
        return $this->updateDate;
    }

    /**
     * Set user
     *
     * @param Witty\UserBundle\Entity\User $user
     * @return UserReward
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
     * Set reward
     *
     * @param Witty\ProjectBundle\Entity\Reward $reward
     * @return UserReward
     */
    public function setReward(\Witty\ProjectBundle\Entity\Reward $reward = null)
    {
        $this->reward = $reward;
    
        return $this;
    }

    /**
     * Get reward
     *
     * @return Witty\ProjectBundle\Entity\Reward 
     */
    public function getReward()
    {
        return $this->reward;
    }

    /**
     * Set paidAmount
     *
     * @param integer $paidAmount
     * @return UserReward
     */
    public function setPaidAmount($paidAmount)
    {
        $this->paidAmount = $paidAmount;
    
        return $this;
    }

    /**
     * Get paidAmount
     *
     * @return integer 
     */
    public function getPaidAmount()
    {
        return $this->paidAmount;
    }
}