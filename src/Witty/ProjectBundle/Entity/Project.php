<?php

namespace Witty\ProjectBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Witty\ProjectBundle\Entity\Project
 *
 * @ORM\Table(name="project")
 * @ORM\Entity
 */
class Project
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
	 * @ORM\ManyToOne(targetEntity="\Witty\UserBundle\Entity\User", inversedBy="projects")
     * @ORM\JoinColumn(name="creator_id", referencedColumnName="id")
     */
    private $creator;

    /**
     * @var string $title
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=true)
     */
    private $title;

    /**
     * @var boolean $category
     *
     * @ORM\Column(name="category", type="boolean", nullable=false)
     */
    private $category;

    /**
     * @var boolean $funded
     *
     * @ORM\Column(name="funded", type="boolean", nullable=false)
     */
    private $funded;

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
     * @var \DateTime $startDate
     *
     * @ORM\Column(name="start_date", type="datetime", nullable=true)
     */
    private $startDate;

    /**
     * @var \DateTime $endDate
     *
     * @ORM\Column(name="end_date", type="datetime", nullable=true)
     */
    private $endDate;

    /**
     * @var integer $fundingGoal
     *
     * @ORM\Column(name="funding_goal", type="integer", nullable=false)
     */
    private $fundingGoal;

    /**
     * @var string $image
     *
     * @ORM\Column(name="image", type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @var string $video
     *
     * @ORM\Column(name="video", type="string", length=255, nullable=true)
     */
    private $video;

    /**
     * @var string $description
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity="Reward", mappedBy="project")
     */
    protected $rewards;
	
	
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
     * Set creatorId
     *
     * @param integer $creatorId
     * @return Project
     */
    public function setCreatorId($creatorId)
    {
        $this->creatorId = $creatorId;
    
        return $this;
    }

    /**
     * Get creatorId
     *
     * @return integer 
     */
    public function getCreatorId()
    {
        return $this->creatorId;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Project
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
     * Set category
     *
     * @param boolean $category
     * @return Project
     */
    public function setCategory($category)
    {
        $this->category = $category;
    
        return $this;
    }

    /**
     * Get category
     *
     * @return boolean 
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set funded
     *
     * @param boolean $funded
     * @return Project
     */
    public function setFunded($funded)
    {
        $this->funded = $funded;
    
        return $this;
    }

    /**
     * Get funded
     *
     * @return boolean 
     */
    public function getFunded()
    {
        return $this->funded;
    }

    /**
     * Set creationDate
     *
     * @param \DateTime $creationDate
     * @return Project
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
     * @return Project
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
     * Set startDate
     *
     * @param \DateTime $startDate
     * @return Project
     */
    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;
    
        return $this;
    }

    /**
     * Get startDate
     *
     * @return \DateTime 
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * Set endDate
     *
     * @param \DateTime $endDate
     * @return Project
     */
    public function setEndDate($endDate)
    {
        $this->endDate = $endDate;
    
        return $this;
    }

    /**
     * Get endDate
     *
     * @return \DateTime 
     */
    public function getEndDate()
    {
        return $this->endDate;
    }

    /**
     * Set fundingGoal
     *
     * @param integer $fundingGoal
     * @return Project
     */
    public function setFundingGoal($fundingGoal)
    {
        $this->fundingGoal = $fundingGoal;
    
        return $this;
    }

    /**
     * Get fundingGoal
     *
     * @return integer 
     */
    public function getFundingGoal()
    {
        return $this->fundingGoal;
    }

    /**
     * Set image
     *
     * @param string $image
     * @return Project
     */
    public function setImage($image)
    {
        $this->image = $image;
    
        return $this;
    }

    /**
     * Get image
     *
     * @return string 
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set video
     *
     * @param string $video
     * @return Project
     */
    public function setVideo($video)
    {
        $this->video = $video;
    
        return $this;
    }

    /**
     * Get video
     *
     * @return string 
     */
    public function getVideo()
    {
        return $this->video;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Project
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
     * Constructor
     */
    public function __construct()
    {
        $this->rewards = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add rewards
     *
     * @param Witty\ProjectBundle\Entity\Reward $rewards
     * @return Project
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

    /**
     * Set creator
     *
     * @param Witty\UserBundle\Entity\User $creator
     * @return Project
     */
    public function setCreator(\Witty\UserBundle\Entity\User $creator = null)
    {
        $this->creator = $creator;
    
        return $this;
    }

    /**
     * Get creator
     *
     * @return Witty\UserBundle\Entity\User 
     */
    public function getCreator()
    {
        return $this->creator;
    }
}