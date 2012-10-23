<?php

namespace Witty\NewsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Witty\TransactionBundle\Entity\Flux
 *
 * @ORM\Table(name="mwn_flux")
 * @ORM\Entity
 */
class Flux
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
     * @ORM\OneToMany(targetEntity="Item", mappedBy="flux")
     */
    private $items;
	
    /**
     * @ORM\ManyToMany(targetEntity="\Witty\UserBundle\Entity\User", inversedBy="flux")
     * @ORM\JoinTable(name="mwn_user_flux")
     */
    private $users;

    /**
     * @var string $name
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     */
    private $name;	
	
    /**
     * @var string $url
     *
     * @ORM\Column(name="url", type="string", length=255, nullable=true)
     */
    private $url;
	
    /**
     * @var integer $type
     *
     * @ORM\Column(name="type", type="integer", nullable=false)
     */
    private $type;
		

    /**
     * Constructor
     */
    public function __construct()
    {

    }
}