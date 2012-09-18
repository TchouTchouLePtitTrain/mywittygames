<?php

namespace Witty\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Witty\UserBundle\Entity\Reward
 */
class Reward
{
    /**
     * @var integer $id
     */
    private $id;

    /**
     * @var integer $projectId
     */
    private $projectId;

    /**
     * @var integer $pledgeAmount
     */
    private $pledgeAmount;

    /**
     * @var integer $offset
     */
    private $offset;

    /**
     * @var integer $limit
     */
    private $limit;

    /**
     * @var \DateTime $deliveryDate
     */
    private $deliveryDate;

    /**
     * @var \DateTime $creationDate
     */
    private $creationDate;

    /**
     * @var \DateTime $updateDate
     */
    private $updateDate;

    /**
     * @var string $description
     */
    private $description;


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
     * Set projectId
     *
     * @param integer $projectId
     * @return Reward
     */
    public function setProjectId($projectId)
    {
        $this->projectId = $projectId;
    
        return $this;
    }

    /**
     * Get projectId
     *
     * @return integer 
     */
    public function getProjectId()
    {
        return $this->projectId;
    }

    /**
     * Set pledgeAmount
     *
     * @param integer $pledgeAmount
     * @return Reward
     */
    public function setPledgeAmount($pledgeAmount)
    {
        $this->pledgeAmount = $pledgeAmount;
    
        return $this;
    }

    /**
     * Get pledgeAmount
     *
     * @return integer 
     */
    public function getPledgeAmount()
    {
        return $this->pledgeAmount;
    }

    /**
     * Set offset
     *
     * @param integer $offset
     * @return Reward
     */
    public function setOffset($offset)
    {
        $this->offset = $offset;
    
        return $this;
    }

    /**
     * Get offset
     *
     * @return integer 
     */
    public function getOffset()
    {
        return $this->offset;
    }

    /**
     * Set limit
     *
     * @param integer $limit
     * @return Reward
     */
    public function setLimit($limit)
    {
        $this->limit = $limit;
    
        return $this;
    }

    /**
     * Get limit
     *
     * @return integer 
     */
    public function getLimit()
    {
        return $this->limit;
    }

    /**
     * Set deliveryDate
     *
     * @param \DateTime $deliveryDate
     * @return Reward
     */
    public function setDeliveryDate($deliveryDate)
    {
        $this->deliveryDate = $deliveryDate;
    
        return $this;
    }

    /**
     * Get deliveryDate
     *
     * @return \DateTime 
     */
    public function getDeliveryDate()
    {
        return $this->deliveryDate;
    }

    /**
     * Set creationDate
     *
     * @param \DateTime $creationDate
     * @return Reward
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
     * @return Reward
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
     * Set description
     *
     * @param string $description
     * @return Reward
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
}
