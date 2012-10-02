<?php

namespace Witty\TransactionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Witty\TransactionBundle\Entity\Ipn
 *
 * @ORM\Table(name="ipn")
 * @ORM\Entity
 */
class Ipn
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
     * @var \DateTime $dateReception
     *
     * @ORM\Column(name="date_reception", type="datetime", nullable=false)
     */
    private $dateReception;
	
    /**
     * @var string $origin
     *
     * @ORM\Column(name="origin", type="string", length=20, nullable=true)
     */
    private $origin;

    /**
     * @var string $ipn
     *
     * @ORM\Column(name="ipn", type="string", length=1024, nullable=false)
     */
    private $ipn;
		
    /**
     * Constructor
     */
    public function __construct($ipn)
    {
        $this->dateReception = new \DateTime();
		$this->ipn = $ipn;
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
     * Set dateReception
     *
     * @param \DateTime $dateReception
     * @return Ipn
     */
    public function setDateReception($dateReception)
    {
        $this->dateReception = $dateReception;
    
        return $this;
    }

    /**
     * Get dateReception
     *
     * @return \DateTime 
     */
    public function getDateReception()
    {
        return $this->dateReception;
    }

    /**
     * Set origin
     *
     * @param string $origin
     * @return Ipn
     */
    public function setOrigin($origin)
    {
        $this->origin = $origin;
    
        return $this;
    }

    /**
     * Get origin
     *
     * @return string 
     */
    public function getOrigin()
    {
        return $this->origin;
    }

    /**
     * Set ipn
     *
     * @param string $ipn
     * @return Ipn
     */
    public function setIpn($ipn)
    {
        $this->ipn = $ipn;
    
        return $this;
    }

    /**
     * Get ipn
     *
     * @return string 
     */
    public function getIpn()
    {
        return $this->ipn;
    }
}