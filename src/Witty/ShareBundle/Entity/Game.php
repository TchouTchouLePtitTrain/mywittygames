<?php

namespace Witty\ShareBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Witty\ShareBundle\Entity\Game
 */
class Game
{
    /**
     * @var integer $id
     */
    private $id;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    protected $shares;
	
    /**
     * @var integer $levelId
     */
    private $levelId;

    /**
     * @var \DateTime $createdAt
     */
    private $createdAt;

    /**
     * @var \DateTime $updatedAt
     */
    private $updatedAt;

    /**
     * @var string $name
     */
    private $name;

    /**
     * @var string $slug
     */
    private $slug;

    /**
     * @var string $catchPhrase
     */
    private $catchPhrase;

    /**
     * @var float $totalInvestmentValue
     */
    private $totalInvestmentValue;

    /**
     * @var float $partInvestmentValue
     */
    private $partInvestmentValue;

    /**
     * @var string $miniDescription
     */
    private $miniDescription;

    /**
     * @var string $shortDescription
     */
    private $shortDescription;

    /**
     * @var string $rules
     */
    private $rules;

    /**
     * @var string $duration
     */
    private $duration;

    /**
     * @var string $playerNumbers
     */
    private $playerNumbers;

    /**
     * @var string $rulesUrl
     */
    private $rulesUrl;

    /**
     * @var string $prototype
     */
    private $prototype;

    /**
     * @var string $videoPresentation
     */
    private $videoPresentation;

    /**
     * @var string $videoExplipartie
     */
    private $videoExplipartie;

    /**
     * @var string $defaultLocale
     */
    private $defaultLocale;

    /**
     * @var boolean $copyright
     */
    private $copyright;

    /**
     * @var \DateTime $deadline
     */
    private $deadline;

    /**
     * @var boolean $isPublish
     */
    private $isPublish;

    /**
     * @var boolean $jauge
     */
    private $jauge;

    /**
     * @var string $urlFacebook
     */
    private $urlFacebook;


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
     * Set levelId
     *
     * @param integer $levelId
     * @return Game
     */
    public function setLevelId($levelId)
    {
        $this->levelId = $levelId;
    
        return $this;
    }

    /**
     * Get levelId
     *
     * @return integer 
     */
    public function getLevelId()
    {
        return $this->levelId;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Game
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
     * @return Game
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
     * Set name
     *
     * @param string $name
     * @return Game
     */
    public function setName($name)
    {
        $this->name = $name;
    
        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return Game
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
     * Set catchPhrase
     *
     * @param string $catchPhrase
     * @return Game
     */
    public function setCatchPhrase($catchPhrase)
    {
        $this->catchPhrase = $catchPhrase;
    
        return $this;
    }

    /**
     * Get catchPhrase
     *
     * @return string 
     */
    public function getCatchPhrase()
    {
        return $this->catchPhrase;
    }

    /**
     * Set totalInvestmentValue
     *
     * @param float $totalInvestmentValue
     * @return Game
     */
    public function setTotalInvestmentValue($totalInvestmentValue)
    {
        $this->totalInvestmentValue = $totalInvestmentValue;
    
        return $this;
    }

    /**
     * Get totalInvestmentValue
     *
     * @return float 
     */
    public function getTotalInvestmentValue()
    {
        return $this->totalInvestmentValue;
    }

    /**
     * Set partInvestmentValue
     *
     * @param float $partInvestmentValue
     * @return Game
     */
    public function setPartInvestmentValue($partInvestmentValue)
    {
        $this->partInvestmentValue = $partInvestmentValue;
    
        return $this;
    }

    /**
     * Get partInvestmentValue
     *
     * @return float 
     */
    public function getPartInvestmentValue()
    {
        return $this->partInvestmentValue;
    }

    /**
     * Set miniDescription
     *
     * @param string $miniDescription
     * @return Game
     */
    public function setMiniDescription($miniDescription)
    {
        $this->miniDescription = $miniDescription;
    
        return $this;
    }

    /**
     * Get miniDescription
     *
     * @return string 
     */
    public function getMiniDescription()
    {
        return $this->miniDescription;
    }

    /**
     * Set shortDescription
     *
     * @param string $shortDescription
     * @return Game
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
     * Set rules
     *
     * @param string $rules
     * @return Game
     */
    public function setRules($rules)
    {
        $this->rules = $rules;
    
        return $this;
    }

    /**
     * Get rules
     *
     * @return string 
     */
    public function getRules()
    {
        return $this->rules;
    }

    /**
     * Set duration
     *
     * @param string $duration
     * @return Game
     */
    public function setDuration($duration)
    {
        $this->duration = $duration;
    
        return $this;
    }

    /**
     * Get duration
     *
     * @return string 
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * Set playerNumbers
     *
     * @param string $playerNumbers
     * @return Game
     */
    public function setPlayerNumbers($playerNumbers)
    {
        $this->playerNumbers = $playerNumbers;
    
        return $this;
    }

    /**
     * Get playerNumbers
     *
     * @return string 
     */
    public function getPlayerNumbers()
    {
        return $this->playerNumbers;
    }

    /**
     * Set rulesUrl
     *
     * @param string $rulesUrl
     * @return Game
     */
    public function setRulesUrl($rulesUrl)
    {
        $this->rulesUrl = $rulesUrl;
    
        return $this;
    }

    /**
     * Get rulesUrl
     *
     * @return string 
     */
    public function getRulesUrl()
    {
        return $this->rulesUrl;
    }

    /**
     * Set prototype
     *
     * @param string $prototype
     * @return Game
     */
    public function setPrototype($prototype)
    {
        $this->prototype = $prototype;
    
        return $this;
    }

    /**
     * Get prototype
     *
     * @return string 
     */
    public function getPrototype()
    {
        return $this->prototype;
    }

    /**
     * Set videoPresentation
     *
     * @param string $videoPresentation
     * @return Game
     */
    public function setVideoPresentation($videoPresentation)
    {
        $this->videoPresentation = $videoPresentation;
    
        return $this;
    }

    /**
     * Get videoPresentation
     *
     * @return string 
     */
    public function getVideoPresentation()
    {
        return $this->videoPresentation;
    }

    /**
     * Set videoExplipartie
     *
     * @param string $videoExplipartie
     * @return Game
     */
    public function setVideoExplipartie($videoExplipartie)
    {
        $this->videoExplipartie = $videoExplipartie;
    
        return $this;
    }

    /**
     * Get videoExplipartie
     *
     * @return string 
     */
    public function getVideoExplipartie()
    {
        return $this->videoExplipartie;
    }

    /**
     * Set defaultLocale
     *
     * @param string $defaultLocale
     * @return Game
     */
    public function setDefaultLocale($defaultLocale)
    {
        $this->defaultLocale = $defaultLocale;
    
        return $this;
    }

    /**
     * Get defaultLocale
     *
     * @return string 
     */
    public function getDefaultLocale()
    {
        return $this->defaultLocale;
    }

    /**
     * Set copyright
     *
     * @param boolean $copyright
     * @return Game
     */
    public function setCopyright($copyright)
    {
        $this->copyright = $copyright;
    
        return $this;
    }

    /**
     * Get copyright
     *
     * @return boolean 
     */
    public function getCopyright()
    {
        return $this->copyright;
    }

    /**
     * Set deadline
     *
     * @param \DateTime $deadline
     * @return Game
     */
    public function setDeadline($deadline)
    {
        $this->deadline = $deadline;
    
        return $this;
    }

    /**
     * Get deadline
     *
     * @return \DateTime 
     */
    public function getDeadline()
    {
        return $this->deadline;
    }

    /**
     * Set isPublish
     *
     * @param boolean $isPublish
     * @return Game
     */
    public function setIsPublish($isPublish)
    {
        $this->isPublish = $isPublish;
    
        return $this;
    }

    /**
     * Get isPublish
     *
     * @return boolean 
     */
    public function getIsPublish()
    {
        return $this->isPublish;
    }

    /**
     * Set jauge
     *
     * @param boolean $jauge
     * @return Game
     */
    public function setJauge($jauge)
    {
        $this->jauge = $jauge;
    
        return $this;
    }

    /**
     * Get jauge
     *
     * @return boolean 
     */
    public function getJauge()
    {
        return $this->jauge;
    }

    /**
     * Set urlFacebook
     *
     * @param string $urlFacebook
     * @return Game
     */
    public function setUrlFacebook($urlFacebook)
    {
        $this->urlFacebook = $urlFacebook;
    
        return $this;
    }

    /**
     * Get urlFacebook
     *
     * @return string 
     */
    public function getUrlFacebook()
    {
        return $this->urlFacebook;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->shares = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add shares
     *
     * @param Witty\ShareBundle\Entity\Share $shares
     * @return Game
     */
    public function addShare(\Witty\ShareBundle\Entity\Share $shares)
    {
        $this->shares[] = $shares;
    
        return $this;
    }

    /**
     * Remove shares
     *
     * @param Witty\ShareBundle\Entity\Share $shares
     */
    public function removeShare(\Witty\ShareBundle\Entity\Share $shares)
    {
        $this->shares->removeElement($shares);
    }

    /**
     * Get shares
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getShares()
    {
        return $this->shares;
    }
	
    /**
     * Get sharesByUserId
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getSharesByUserId($userId)
    {
		$function = function($id) //La closure pour pouvoir utiliser l'userId
			{
				return function($x) use ($id) { return ($x->getUser()->getId() == $id) && (!$x->getIsCancelled()); };
			};
	
        return $this->getShares()->filter($function($userId));
    }
	
}