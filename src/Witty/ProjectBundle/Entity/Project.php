<?php

namespace Witty\ProjectBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Witty\ProjectBundle\Entity\Project
 *
 * @ORM\Table(name="project", uniqueConstraints={@ORM\UniqueConstraint(name="project_slug", columns={"slug"})}))
 * @ORM\Entity(repositoryClass="Witty\ProjectBundle\Repository\ProjectRepository")
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
     * @ORM\OneToMany(targetEntity="Reward", mappedBy="project")
     */
    protected $rewards;
	
    /**
     * @ORM\OneToOne(targetEntity="Reward")
	 * @ORM\JoinColumn(name="rewarddefault_id", referencedColumnName="id")
     */
    protected $rewardParDefaut;
	
    /**
     * @ORM\OneToMany(targetEntity="Comment", mappedBy="project")
     */
    protected $comments;
	
    /**
     * @ORM\OneToMany(targetEntity="News", mappedBy="project")
     */
    protected $news;
	
	
    /**
     * @var string $title
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=true)
     */
    private $title;

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
     * @var string $imageSecondaire
     *
     * @ORM\Column(name="image_secondaire", type="string", length=255, nullable=true)
     */
    private $imageSecondaire;
	
    /**
     * @var string $imageAchat
     *
     * @ORM\Column(name="image_achat", type="string", length=255, nullable=true)
     */
    private $imageAchat;

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
     * @var string $shortDescription
     *
     * @ORM\Column(name="short_description", type="string", length=255)
     */
    private $shortDescription;	
	
    /**
     * @var string $mediumDescription
     *
     * @ORM\Column(name="medium_description", type="string", length=510)
     */
    private $mediumDescription;
	
    /**
     * @var string $slug
     *
     * @ORM\Column(name="slug", type="string", length=255)
     */
    protected $slug;		
	
    /**
     * @var integer $priority
     *
     * @ORM\Column(name="priority", type="integer", nullable=true)
     */
    protected $priority = 100;
	
    /**
     * @var string $state
     *
     * @ORM\Column(name="state", type="string", length=20)
     */
    protected $state;	
	
    /**
     * @var string $buyLink
     *
     * @ORM\Column(name="buy_link", type="string", length=255)
     */
    protected $buyLink;
	
	
	
    /**
     * non mappé
	 * Array des UserRewards du projet
     */
    protected $userRewards;	
	
    /**
     * non mappé
	 * Array des édinautes du projet
     */
    //protected $edinautes;
	
    /**
     * non mappé
	 * Integer : montant total investi sur le projet
     */
    protected $funding;
	
	
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
	
	/**
     * Get Edinautes - renvoie les ids au lieu des édinautes à cause d'une anomalie php (voir ci-dessous)
     *
     * @return Array
     */
	public function getEdinautes()
	{
		//On est obligés de passer par les ids à cause d'une anomalie php. 
		// Le tableau des édinautes est en effet bien mis à jour dans la boucle foreach (var_dump) mais lorsqu'on le retourne, il ne contient plus que le premier élément.
		// Le var_dump modifie la variable
		// voir http://stackoverflow.com/questions/6571250/var-dump-changes-the-result-of-the-function
		// Mais cela n'explique pas pourquoi sans les var_dump, seul le premier élément est retourné...
		
		//Ancien code 
		// $edinautes = array();

		// foreach($this->getUserRewards() as $userReward)
		// {
			// if (!in_array($userReward->getUser(), $edinautes)) $edinautes[] = $userReward->getUser(); //Si l'édinaute n'est pas déjà dans la liste, on l'ajoute
// var_dump($edinautes);
		// }
// echo 'apres la boucle';
// var_dump($edinautes);		
		// return $edinautes;	
		// Fin ancien code
		
		$ids_edinautes = array();

		foreach($this->getUserRewards() as $userReward)
		{
			if (!in_array($userReward->getUser()->getId(), $ids_edinautes) && (!$userReward->getCancelled()))
			{
				$ids_edinautes[] = $userReward->getUser()->getId(); //Si l'édinaute n'est pas déjà dans la liste, on l'ajoute
			}
		}

		return $ids_edinautes;
	}
	
	
	 /**
     * Get Edinautes
     *
     * @return Array
     */
	 /* A réactiver si on ajoute les édinautes au projet au moment où ils investissent
	public function getEdinautes()
	{
		if (!$this->edinautes) $this->setEdinautes();
		return $this->edinautes;
	}
	*/
	
	
	/**
     * Set Edinautes
     *
     */
	 /*
	public function setEdinautes()
	{
		$edinautes = array();

		foreach($this->getUserRewards() as $userReward)
		{
			if (!in_array($userReward->getUser(), $edinautes)) $edinautes[] = $userReward->getUser(); //Si l'édinaute n'est pas déjà dans la liste, on l'ajoute
		}
		
		$this->edinautes = $edinautes;
	}
	*/
		
		
	/**
     * Get userRewards
     *
     * @return Array
     */
	public function getUserRewards()
	{
		if (!$this->userRewards) $this->setUserRewards();
		return $this->userRewards;
	}
	
	
	/**
     * Set userRewards
     *
     */
	public function setUserRewards()
	{
		$userRewards = new \Doctrine\Common\Collections\ArrayCollection();

		foreach($this->getRewards() as $reward)
		{
			foreach($reward->getUserRewards() as $userReward)
			{
				$userRewards->add($userReward);
			}
		}
		
		$this->userRewards = $userRewards;
	}
	
	
	
	
	/**
     * Set Funding
     *
     */
	public function setFunding()
	{
		$funding = 0;
		
		foreach($this->getUserRewards() as $userReward)
		{
			$funding += $userReward->getReward()->getCost();
		}
		
		$this->funding = $funding;
	}
	
	
	/**
     * Get Funding
     *
     * @return integer
     */
	public function getFunding()
	{
		if (!isset($this->funding)) $this->setFunding();
		return $this->funding;
	}	
	
	
	/**
     * Get TimeLeft
     *
     * @return integer
     */
	public function getTimeLeft()
	{
		return $this->getEndDate()->diff(new \DateTime())->days;
	}		
	
	/**
     * Is Over
     *
     * @return boolean
     */
	public function isOver()
	{
		return $this->getEndDate() < new \DateTime();
	}	
	
	/**
     * Get LaunchDate
     *
     * @return integer
     */
	public function getLaunchDate()
	{
		return strftime('%d %B', $this->getStartDate()->getTimestamp());
	}
	
	

    /**
     * Set shortDescription
     *
     * @param string $shortDescription
     * @return Project
     */
    public function setShortDescription($shortDescription)
    {
        $this->shortDescription = $shortDescription;
    
        return $this;
    }

    /**
     * Get shortDescription
     *
     * @return string 
     */
    public function getShortDescription()
    {
        return $this->shortDescription;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return Project
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
    
        return $this;
    }

    /**
     * Get slug
     *
     * @return string 
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Add comments
     *
     * @param Witty\ProjectBundle\Entity\Comment $comments
     * @return Project
     */
    public function addComment(\Witty\ProjectBundle\Entity\Comment $comments)
    {
        $this->comments[] = $comments;
    
        return $this;
    }

    /**
     * Remove comments
     *
     * @param Witty\ProjectBundle\Entity\Comment $comments
     */
    public function removeComment(\Witty\ProjectBundle\Entity\Comment $comments)
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
     * Add news
     *
     * @param Witty\ProjectBundle\Entity\News $news
     * @return Project
     */
    public function addNews(\Witty\ProjectBundle\Entity\News $news)
    {
        $this->news[] = $news;
    
        return $this;
    }

    /**
     * Remove news
     *
     * @param Witty\ProjectBundle\Entity\News $news
     */
    public function removeNews(\Witty\ProjectBundle\Entity\News $news)
    {
        $this->news->removeElement($news);
    }

    /**
     * Get news
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getNews()
    {
        return $this->news;
    }

    /**
     * Add news
     *
     * @param Witty\ProjectBundle\Entity\News $news
     * @return Project
     */
    public function addNew(\Witty\ProjectBundle\Entity\News $news)
    {
        $this->news[] = $news;
    
        return $this;
    }

    /**
     * Remove news
     *
     * @param Witty\ProjectBundle\Entity\News $news
     */
    public function removeNew(\Witty\ProjectBundle\Entity\News $news)
    {
        $this->news->removeElement($news);
    }
	
	
		
    /**
     * Get rewardsByUserId
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getUserRewardsByUserId($userId)
    {
		$function = function($id) //La closure pour pouvoir utiliser l'userId
			{
				return function($x) use ($id) { return ($x->getUser()->getId() == $id) && (!$x->getCancelled()); };
			};
			
        return $this->getUserRewards()->filter($function($userId));
    }
	
	

    /**
     * Set priority
     *
     * @param integer $priority
     * @return Project
     */
    public function setPriority($priority)
    {
        $this->priority = $priority;
    
        return $this;
    }

    /**
     * Get priority
     *
     * @return integer 
     */
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * Set mediumDescription
     *
     * @param string $mediumDescription
     * @return Project
     */
    public function setMediumDescription($mediumDescription)
    {
        $this->mediumDescription = $mediumDescription;
    
        return $this;
    }

    /**
     * Get mediumDescription
     *
     * @return string 
     */
    public function getMediumDescription()
    {
        return $this->mediumDescription;
    }

    /**
     * Set rewardParDefaut
     *
     * @param Witty\ProjectBundle\Entity\Reward $rewardParDefaut
     * @return Project
     */
    public function setRewardParDefaut(\Witty\ProjectBundle\Entity\Reward $rewardParDefaut = null)
    {
        $this->rewardParDefaut = $rewardParDefaut;
    
        return $this;
    }

    /**
     * Get rewardParDefaut
     *
     * @return Witty\ProjectBundle\Entity\Reward 
     */
    public function getRewardParDefaut()
    {
        return $this->rewardParDefaut;
    }

    /**
     * Set imageSecondaire
     *
     * @param string $imageSecondaire
     * @return Project
     */
    public function setImageSecondaire($imageSecondaire)
    {
        $this->imageSecondaire = $imageSecondaire;
    
        return $this;
    }

    /**
     * Get imageSecondaire
     *
     * @return string 
     */
    public function getImageSecondaire()
    {
        return $this->imageSecondaire;
    }

    /**
     * Set imageAchat
     *
     * @param string $imageAchat
     * @return Project
     */
    public function setImageAchat($imageAchat)
    {
        $this->imageAchat = $imageAchat;
    
        return $this;
    }

    /**
     * Get imageAchat
     *
     * @return string 
     */
    public function getImageAchat()
    {
        return $this->imageAchat;
    }

    /**
     * Set state
     *
     * @param string $state
     * @return Project
     */
    public function setState($state)
    {
        $this->state = $state;
    
        return $this;
    }

    /**
     * Get state
     *
     * @return string 
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Set buyLink
     *
     * @param string $buyLink
     * @return Project
     */
    public function setBuyLink($buyLink)
    {
        $this->buyLink = $buyLink;
    
        return $this;
    }

    /**
     * Get buyLink
     *
     * @return string 
     */
    public function getBuyLink()
    {
        return $this->buyLink;
    }
}