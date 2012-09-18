<?php

namespace Witty\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Witty\UserBundle\Entity\UserReward
 */
class UserReward
{
    /**
     * @var integer $id
     */
    private $id;

    /**
     * @var integer $userId
     */
    private $userId;

    /**
     * @var integer $rewardId
     */
    private $rewardId;

    /**
     * @var boolean $cancelled
     */
    private $cancelled;

    /**
     * @var \DateTime $creationDate
     */
    private $creationDate;

    /**
     * @var \DateTime $updateDate
     */
    private $updateDate;


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
     * Set userId
     *
     * @param integer $userId
     * @return UserReward
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
    
        return $this;
    }

    /**
     * Get userId
     *
     * @return integer 
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set rewardId
     *
     * @param integer $rewardId
     * @return UserReward
     */
    public function setRewardId($rewardId)
    {
        $this->rewardId = $rewardId;
    
        return $this;
    }

    /**
     * Get rewardId
     *
     * @return integer 
     */
    public function getRewardId()
    {
        return $this->rewardId;
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
}
