<?php

namespace Witty\UserBundle\Entity;

use FOS\UserBundle\Entity\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Gaufrette\Filesystem;
use Gaufrette\Adapter\AmazonS3 as AmazonS3Adapter;

/**
 * Witty\UserBundle\Entity\User
 * @ORM\Entity(repositoryClass="Witty\UserBundle\Repository\UserRepository")
 * @ORM\Table(name="user")
 */
class User extends BaseUser
{
    /**
     * @var integer $id
     */
    protected $id;
	
    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    private $shares;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    private $userRewards;
	
    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    private $userRewardOptions;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    private $projects;
	
    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    private $projectComments;
	
    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    private $postComments;
	
    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    private $flux;
	
    /**
     * @var \DateTime $createdAt
     */
    private $createdAt;

    /**
     * @var \DateTime $updatedAt
     */
    private $updatedAt;

    /**
     * @var string $login
     */
    private $login;

    /**
     * @var string $firstname
     */
    private $firstname;

    /**
     * @var string $lastname
     */
    private $lastname;

    /**
     * @var string $address
     */
    private $address;

    /**
     * @var string $address2
     */
    private $address2;

    /**
     * @var string $city
     */
    private $city;

    /**
     * @var string $postcode
     */
    private $postcode;

    /**
     * @var string $description
     */
    private $description;

    /**
     * @var float $credit
     */
    private $credit;

    /**
     * @var string $sex
     */
    private $sex;

    /**
     * @var string $avatar
     */
    private $avatar;
    
    /**
     * @var string $avatarFile
     */
    public $avatarFile;

    /**
     * @var string $activationCode
     */
    private $activationCode;

    /**
     * @var \DateTime $birthdate
     */
    private $birthdate;

    /**
     * @var boolean $isEditor
     */
    private $isEditor;

    /**
     * @var boolean $isAuthor
     */
    private $isAuthor;

    /**
     * @var string $defaultLocale
     */
    private $defaultLocale;

    /**
     * @var string $country
     */
    private $country;

    /**
     * @var integer $fbId
     */
    private $fbId;

    /**
     * @var string $loginDp
     */
    private $loginDp;

    /**
     * @var string $passwordDp
     */
    private $passwordDp;
	
    /**
     * @var boolean $newsletter
     */
    private $newsletter;
	
    /**
     * @var string $phone
     */
    private $phone;
	
    /**
     * @var sgtring $old_password
     */
    private $old_password;	
	
	/**
     * @var string $facebookId
     *
     */
    protected $facebookId;
	
	
	
	
    /**
     * Cet attribut n'est pas mappé
     */
    private $token;
	
    /**
     * Cet attribut n'est pas mappé
     */
    private $token_mws;	
	
    /**
     * Cet attribut n'est pas mappé
	 * Array de Project
     */
    private $projectsFunded;
	
    /**
     * Cet attribut n'est pas mappé
	 * Array de Game
     */
    private $games;

	
	
	public function __construct(){
	
		parent::__construct();
		$this->createdAt = new \Datetime();
		$this->credit = 0;
		$this->newsletter = true;
		$this->shares = new \Doctrine\Common\Collections\ArrayCollection();
		$this->userRewards = new \Doctrine\Common\Collections\ArrayCollection();
		$this->userRewardOptions = new \Doctrine\Common\Collections\ArrayCollection();
		$this->projects = new \Doctrine\Common\Collections\ArrayCollection();
	}
	
	public function serialize()
    {
        return serialize(array($this->facebookId, parent::serialize()));
    }

    public function unserialize($data)
    {
        list($this->facebookId, $parentData) = unserialize($data);
        parent::unserialize($parentData);
    }	
	
	
    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return User
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
     * @return User
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
     * Set login
     *
     * @param string $login
     * @return User
     */
    public function setLogin($login)
    {
        $this->login = $login;
    
        return $this;
    }

    /**
     * Get login
     *
     * @return string 
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * Set firstname
     *
     * @param string $firstname
     * @return User
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    
        return $this;
    }

    /**
     * Get firstname
     *
     * @return string 
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set lastname
     *
     * @param string $lastname
     * @return User
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    
        return $this;
    }

    /**
     * Get lastname
     *
     * @return string 
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set address
     *
     * @param string $address
     * @return User
     */
    public function setAddress($address)
    {
        $this->address = $address;
    
        return $this;
    }

    /**
     * Get address
     *
     * @return string 
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set address2
     *
     * @param string $address2
     * @return User
     */
    public function setAddress2($address2)
    {
        $this->address2 = $address2;
    
        return $this;
    }

    /**
     * Get address2
     *
     * @return string 
     */
    public function getAddress2()
    {
        return $this->address2;
    }

    /**
     * Set city
     *
     * @param string $city
     * @return User
     */
    public function setCity($city)
    {
        $this->city = $city;
    
        return $this;
    }

    /**
     * Get city
     *
     * @return string 
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set postcode
     *
     * @param string $postcode
     * @return User
     */
    public function setPostcode($postcode)
    {
        $this->postcode = $postcode;
    
        return $this;
    }

    /**
     * Get postcode
     *
     * @return string 
     */
    public function getPostcode()
    {
        return $this->postcode;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return User
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
     * Set credit
     *
     * @param float $credit
     * @return User
     */
    public function setCredit($credit)
    {
        $this->credit = $credit;
    
        return $this;
    }

    /**
     * Get credit
     *
     * @return float 
     */
    public function getCredit()
    {
        return $this->credit;
    }

    /**
     * Set sex
     *
     * @param string $sex
     * @return User
     */
    public function setSex($sex)
    {
        $this->sex = $sex;
    
        return $this;
    }

    /**
     * Get sex
     *
     * @return string 
     */
    public function getSex()
    {
        return $this->sex;
    }

    /**
     * Set avatar
     *
     * @param string $avatar
     * @return User
     */
    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;
    
        return $this;
    }

    /**
     * Get avatar
     *
     * @return string 
     */
    public function getAvatar()
    {
        return $this->avatar;
    }

    /**
     * Set activationCode
     *
     * @param string $activationCode
     * @return User
     */
    public function setActivationCode($activationCode)
    {
        $this->activationCode = $activationCode;
    
        return $this;
    }

    /**
     * Get activationCode
     *
     * @return string 
     */
    public function getActivationCode()
    {
        return $this->activationCode;
    }

    /**
     * Set birthdate
     *
     * @param \DateTime $birthdate
     * @return User
     */
    public function setBirthdate($birthdate)
    {
        $this->birthdate = $birthdate;
    
        return $this;
    }

    /**
     * Get birthdate
     *
     * @return \DateTime 
     */
    public function getBirthdate()
    {
        return $this->birthdate;
    }

    /**
     * Set isEditor
     *
     * @param boolean $isEditor
     * @return User
     */
    public function setIsEditor($isEditor)
    {
        $this->isEditor = $isEditor;
    
        return $this;
    }

    /**
     * Get isEditor
     *
     * @return boolean 
     */
    public function getIsEditor()
    {
        return $this->isEditor;
    }

    /**
     * Set isAuthor
     *
     * @param boolean $isAuthor
     * @return User
     */
    public function setIsAuthor($isAuthor)
    {
        $this->isAuthor = $isAuthor;
    
        return $this;
    }

    /**
     * Get isAuthor
     *
     * @return boolean 
     */
    public function getIsAuthor()
    {
        return $this->isAuthor;
    }

    /**
     * Set defaultLocale
     *
     * @param string $defaultLocale
     * @return User
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
     * Set country
     *
     * @param string $country
     * @return User
     */
    public function setCountry($country)
    {
        $this->country = $country;
    
        return $this;
    }

    /**
     * Get country
     *
     * @return string 
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set fbId
     *
     * @param integer $fbId
     * @return User
     */
    public function setFbId($fbId)
    {
        $this->fbId = $fbId;
    
        return $this;
    }

    /**
     * Get fbId
     *
     * @return integer 
     */
    public function getFbId()
    {
        return $this->fbId;
    }

    /**
     * Set loginDp
     *
     * @param string $loginDp
     * @return User
     */
    public function setLoginDp($loginDp)
    {
        $this->loginDp = $loginDp;
    
        return $this;
    }

    /**
     * Get loginDp
     *
     * @return string 
     */
    public function getLoginDp()
    {
        return $this->loginDp;
    }

    /**
     * Set passwordDp
     *
     * @param string $passwordDp
     * @return User
     */
    public function setPasswordDp($passwordDp)
    {
        $this->passwordDp = $passwordDp;
    
        return $this;
    }

    /**
     * Get passwordDp
     *
     * @return string 
     */
    public function getPasswordDp()
    {
        return $this->passwordDp;
    }

    /**
     * Set origine
     *
     * @param boolean $origine
     * @return User
     */
    public function setOrigine($origine)
    {
        $this->origine = $origine;
    
        return $this;
    }

    /**
     * Get origine
     *
     * @return boolean 
     */
    public function getOrigine()
    {
        return $this->origine;
    }
	
    /**
     * Set newsletter
     *
     * @param boolean $newsletter
     * @return User
     */
    public function setNewsletter($newsletter = null)
    {
        $this->newsletter = $newsletter;
    
        return $this;
    }

    /**
     * Get newsletter
     *
     * @return boolean
     */
    public function getNewsletter()
    {
        return $this->newsletter;
    }
	
    /**
     * Set token
     *
     * @return User
     */
    public function setToken()
    {
        $this->token = $this->password.$this->id;
    
        return $this;
    }

    /**
     * Get token
     *
     * @return string
     */
    public function getToken()
    {
        return $this->password.'$'.$this->id;
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
     * Set old_password
     *
     * @param string $oldPassword
     * @return User
     */
    public function setOldPassword($oldPassword)
    {
        $this->old_password = $oldPassword;
    
        return $this;
    }

    /**
     * Get old_password
     *
     * @return string 
     */
    public function getOldPassword()
    {
        return $this->old_password;
    }

    /**
     * Set phone
     *
     * @param string $phone
     * @return User
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    
        return $this;
    }

    /**
     * Get phone
     *
     * @return string 
     */
    public function getPhone()
    {
        return $this->phone;
    }


    /**
     * Set facebookId
     *
     * @param string $facebookId
     * @return User
     */
    public function setFacebookId($facebookId)
    {
        $this->facebookId = $facebookId;
    
        return $this;
    }

    /**
     * Get facebookId
     *
     * @return string 
     */
    public function getFacebookId()
    {
        return $this->facebookId;
    }
	

    /**
     * Get projectsFunded
     *
     * @return Array 
     */
    public function setProjectsFunded()
    {
		$projectsFunded = array();
		
		foreach($this->getUserRewards() as $userReward)
		{
			if (!in_array($userReward->getReward()->getProject(), $projectsFunded)) $projectsFunded[] = $userReward->getReward()->getProject(); //Si le projet n'est pas déjà dans la liste, on l'ajoute
		}

		$this->projectsFunded = $projectsFunded;
    }
	
    /**
     * Get projectsFunded
     *
     * @return Array 
     */
    public function getProjectsFunded()
    {
		if (!isset($this->projectsFunded)) $this->setProjectsFunded();
        return $this->projectsFunded;
    }	
		
    /**
     * Add userReward
     *
     * @param Witty\ProjectBundle\Entity\UserReward $userReward
     * @return User
     */
    public function addUserReward(\Witty\ProjectBundle\Entity\UserReward $userReward)
    {
        $this->userRewards[] = $userReward;
		$this->addToCredit(- $userReward->getReward()->getCost());
    
        return $this;
    }

    /**
     * Remove userReward
     *
     * @param Witty\ProjectBundle\Entity\UserReward $userReward
     */
    public function removeUserReward(\Witty\ProjectBundle\Entity\UserReward $userReward)
    {
        $this->userRewards->remove($userReward);
		$this->credit += $userReward->getReward()->getCost();
    }

    /**
     * Get userRewards
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getUserRewards()
    {
        return $this->userRewards->filter(function($x){ return !$x->getCancelled();});
    }

	
	/**
     * @param Array
     */
    public function setFBData($fbdata)
    {
        if (isset($fbdata['id'])) {
            $this->setFacebookId($fbdata['id']);
            $this->addRole('ROLE_FACEBOOK');
        }
        if (isset($fbdata['first_name'])) {
            $this->setFirstname($fbdata['first_name']);
        }
        if (isset($fbdata['last_name'])) {
            $this->setLastname($fbdata['last_name']);
        }
        if (isset($fbdata['email'])) {
            $this->setEmail($fbdata['email']);
			$this->setUsername($fbdata['email']);
        }

		
		
    }
	
	//Renvoie le texte qui doit apparaître pour identifier l'internaute
	public function getLabel($affectueux = false)
	{

		if (isset($this->username)) return $this->username;
		elseif (isset($this->firstname)) return $this->firstname.($affectueux ? $this->lastname : "");
		else return $this->email;
	}
    
    //Renvoie l'avatarFile
    public function getAvatarFile()
    {
        return $this->avatarFile;
    }
	
    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
	 *
	 * Méthode déclenchée lorsque l'on va persister l'user
     */
    public function preUpload()
    {
        if (null !== $this->avatarFile) 
			$this->avatar = $this->avatarFile->getClientOriginalName();
    }


    /**
     * Add shares
     *
     * @param Witty\ShareBundle\Entity\Share $shares
     * @return User
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
     * Add projects
     *
     * @param Witty\ProjectBundle\Entity\Project $projects
     * @return User
     */
    public function addProject(\Witty\ProjectBundle\Entity\Project $projects)
    {
        $this->projects[] = $projects;
    
        return $this;
    }

    /**
     * Remove projects
     *
     * @param Witty\ProjectBundle\Entity\Project $projects
     */
    public function removeProject(\Witty\ProjectBundle\Entity\Project $projects)
    {
        $this->projects->removeElement($projects);
    }

    /**
     * Get projects
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getProjects()
    {
        return $this->projects;
    }
	
    /**
     * Get games
     *
     * @return Doctrine\Common\Collections\Collection 
     */	
	public function getGames()
	{
		if (!$this->games) $this->setGames();
		return $this->games;
	}
	
	
	/**
     * Set Games
     *
     */
	public function setGames()
	{
		$games = array();
		
		if ($this->getShares())
		{
			foreach($this->getShares() as $share)
			{
				$game = $share->getGame();
				if (!in_array($game, $games)) $games[] = $game;
			}
		}
		
		$this->games = $games;
	}
	
	//Renvoi la liste des rewards du User pour un projet donné
	public function getUserRewardsByProjectId($projectId)
	{
		$filter = function($projectId)
				{
					return function($x) use ($projectId) { return $x->getReward()->getProject()->getId() == $projectId; };
				};			

		return $this->getUserRewards()->filter($filter($projectId));
	}		
	
	//Renvoi la liste des rewards du User pour un projet donné
	public function getUserRewardOptionsByProjectId($projectId)
	{
		$filter = function($projectId)
				{
					return function($x) use ($projectId) { return $x->getReward()->getProject()->getId() == $projectId; };
				};			

		return $this->getUserRewardOptions()->filter($filter($projectId));
	}	
	
	
	//Renvoi la liste des options du User pour un reward donné
	public function getUserRewardOptionsByRewardId($rewardId)
	{
		$filter = function($rewardId)
				{
					return function($x) use ($rewardId) { return $x->getReward()->getId() == $rewardId; };
				};			
	
		return $this->getUserRewardOptions()->filter($filter($rewardId));
	}
	
	
	//Calcul du crédit que récupérerait l'user en annulant ses reward sur un projet
	public function getCreditRecuperable($projectId)
	{
		$creditRecuperable = 0;
		foreach ($this->getUserRewardsByProjectId($projectId) as $userReward)
		{
			$creditRecuperable += $userReward->getReward()->getCost(); //Ajout du crédit gagné par la possible annulation du reward
			foreach($this->getUserRewardOptionsByRewardId($userReward->getReward()->getId()) as $userRewardOption) //Ajout du crédit gagné par l'annulation des options
			{	
				$creditRecuperable += $userRewardOption->getRewardOption()->getCost();
			}
		}

		return $creditRecuperable;
	}	
	
    /**
     * Annule les UserReward sur un projet donné
     *
     */
    public function cancelUserRewards($userRewards)
    {
		//Annulation des UserReward
		$map = function($userRewards)
				{
					return function($x) use ($userRewards) 
					{ 
						if ($userRewards->contains($x)) 
						{
							$x->setUpdateDate(new \DateTime);
							$x->setCancelled(true);
							$this->addToCredit($x->getReward()->getCost());
						} 
					};
				};

        $this->getUserRewards()->map($map($userRewards));		
    }
	
	/*
	* Annule les UserRewardOption passées en paramètres
	*
	*/
    public function cancelUserRewardOptions($userRewardOptions)
    {
		//Annulation des UserRewardOption
		$map = function($userRewardOptions)
				{
					return function($x) use ($userRewardOptions) 
					{ 
						if ($userRewardOptions->contains($x))
						{
							$x->setUpdateDate(new \DateTime);
							$x->setCancelled(true);
							$this->addToCredit($x->getRewardOption()->getCost());
						} 
					};
				};
		
        $this->getUserRewardOptions()->map($map($userRewardOptions));	
    }
	

    /**
     * Add userRewardOptions
     *
     * @param Witty\ProjectBundle\Entity\UserRewardOption $userRewardOptions
     * @return User
     */
    public function addUserRewardOption(\Witty\ProjectBundle\Entity\Reward $reward, \Witty\ProjectBundle\Entity\RewardOption $rewardOption)
    {
        $this->userRewardOptions[] = new \Witty\ProjectBundle\Entity\UserRewardOption($this, $reward, $rewardOption);
		$this->addToCredit(- $rewardOption->getCost());
		
		return $this;
    }

    /**
     * Remove userRewardOptions
     *
     * @param Witty\ProjectBundle\Entity\UserRewardOption $userRewardOptions
     */
    public function removeUserRewardOption(\Witty\ProjectBundle\Entity\Reward $reward, \Witty\ProjectBundle\Entity\RewardOption $rewardOptions)
    {
        $this->userRewardOptions->remove($this, new \Witty\ProjectBundle\Entity\UserRewardOption($reward, $rewardOptions));
    }

    /**
     * Get userRewardOptions
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getUserRewardOptions()
    {
        return $this->userRewardOptions->filter(function($x){ return !$x->getCancelled();});
    }
	
	//Crédite la somme donnée à l'User
	public function addToCredit($somme)
	{
		$this->credit = $this->credit + $somme;
	}
    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    private $project_comments;


    /**
     * Add project_comments
     *
     * @param Witty\ProjectBundle\Entity\Comment $projectComments
     * @return User
     */
    public function addProjectComment(\Witty\ProjectBundle\Entity\Comment $projectComments)
    {
        $this->project_comments[] = $projectComments;
    
        return $this;
    }

    /**
     * Remove project_comments
     *
     * @param Witty\ProjectBundle\Entity\Comment $projectComments
     */
    public function removeProjectComment(\Witty\ProjectBundle\Entity\Comment $projectComments)
    {
        $this->project_comments->removeElement($projectComments);
    }

    /**
     * Get project_comments
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getProjectComments()
    {
        return $this->project_comments;
    }

    /**
     * Add flux
     *
     * @param Witty\NewsBundle\Entity\Flux $flux
     * @return User
     */
    public function addFlux(\Witty\NewsBundle\Entity\Flux $flux)
    {
        $this->flux[] = $flux;
    
        return $this;
    }

    /**
     * Remove flux
     *
     * @param Witty\NewsBundle\Entity\Flux $flux
     */
    public function removeFlux(\Witty\NewsBundle\Entity\Flux $flux)
    {
        $this->flux->removeElement($flux);
    }

    /**
     * Get flux
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getFlux()
    {
        return $this->flux;
    }

    /**
     * Add postComments
     *
     * @param Witty\BlogBundle\Entity\Comment $postComments
     * @return User
     */
    public function addPostComment(\Witty\BlogBundle\Entity\Comment $postComments)
    {
        $this->postComments[] = $postComments;
    
        return $this;
    }

    /**
     * Remove postComments
     *
     * @param Witty\BlogBundle\Entity\Comment $postComments
     */
    public function removePostComment(\Witty\BlogBundle\Entity\Comment $postComments)
    {
        $this->postComments->removeElement($postComments);
    }

    /**
     * Get postComments
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getPostComments()
    {
        return $this->postComments;
    }
}