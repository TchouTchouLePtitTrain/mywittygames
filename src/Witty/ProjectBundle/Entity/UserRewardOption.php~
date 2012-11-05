<?php

namespace Witty\ProjectBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Witty\ProjectBundle\Entity\UserRewardOption
 *
 * @ORM\Table(name="user_reward_option")
 * @ORM\Entity
 */
class UserRewardOption
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
	 * @ORM\ManyToOne(targetEntity="Witty\UserBundle\Entity\User", inversedBy="userRewardsOptions")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    /**
	 * @ORM\ManyToOne(targetEntity="Reward", inversedBy="userRewards")
     * @ORM\JoinColumn(name="reward_id", referencedColumnName="id")
     */
    private $reward;
	
    /**
	 * @ORM\ManyToOne(targetEntity="RewardOption", inversedBy="userRewardOptions")
     * @ORM\JoinColumn(name="option_id", referencedColumnName="id")
     */
    private $rewardOption;
	
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


	public function __construct(\Witty\UserBundle\Entity\User $user, \Witty\ProjectBundle\Entity\Reward $reward, \Witty\ProjectBundle\Entity\RewardOption $rewardOption)
	{
		$this->creationDate = new \DateTime();
		$this->cancelled = false;
		$this->user = $user;
		$this->reward = $reward;
		$this->rewardOption = $rewardOption;
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
     * Set cancelled
     *
     * @param boolean $cancelled
     * @return UserRewardOption
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
     * @return UserRewardOption
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
     * @return UserRewardOption
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
     * @return UserRewardOption
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
     * @return UserRewardOption
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
     * Set rewardOption
     *
     * @param Witty\ProjectBundle\Entity\RewardOption $rewardOption
     * @return UserRewardOption
     */
    public function setOption(\Witty\ProjectBundle\Entity\RewardOption $rewardOption = null)
    {
        $this->rewardOption = $rewardOption;
    
        return $this;
    }

    /**
     * Get rewardOption
     *
     * @return Witty\ProjectBundle\Entity\RewardOption 
     */
    public function getRewardOption()
    {
        return $this->rewardOption;
    }

    /**
     * Set rewardOption
     *
     * @param Witty\ProjectBundle\Entity\RewardOption $rewardOption
     * @return UserRewardOption
     */
    public function setRewardOption(\Witty\ProjectBundle\Entity\RewardOption $rewardOption = null)
    {
        $this->rewardOption = $rewardOption;
    
        return $this;
    }
}