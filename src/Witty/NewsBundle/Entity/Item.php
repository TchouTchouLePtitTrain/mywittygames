<?php

namespace Witty\NewsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Witty\TransactionBundle\Entity\Item
 *
 * @ORM\Table(name="mwn_itemflux")
 * @ORM\Entity
 */
class Item
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
     * @ORM\ManyToOne(targetEntity="Flux")
     * @ORM\JoinColumn(name="flux_id", referencedColumnName="id")
     */
    private $flux;

	
    /**
     * @var string $guid
     *
     * @ORM\Column(name="guid", type="string", length=100, nullable=true)
     */
    private $guid;
	
    /**
     * @var string $title
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=true)
     */
    private $title;	
	

    /**
     * @var string $md5_guid
     *
     * @ORM\Column(name="md5_guid", type="string", length=100, nullable=true)
     */
    private $md5_guid;
	
    /**
     * @var string $md5_title
     *
     * @ORM\Column(name="md5_title", type="string", length=100, nullable=true)
     */
    private $md5_title;
	
    /**
     * @var string $author
     *
     * @ORM\Column(name="author", type="string", length=100, nullable=true)
     */
    private $author;
	
    /**
     * @var string $category
     *
     * @ORM\Column(name="category", type="string", length=255, nullable=true)
     */
    private $category;
	
    /**
     * @var string $comments
     *
     * @ORM\Column(name="comments", type="string", length=255, nullable=true)
     */
    private $comments;
	
    /**
     * @var string $description
     *
     * @ORM\Column(name="description", type="string", length=1024, nullable=true)
     */
    private $description;
	
    /**
     * @var string $enclosure
     *
     * @ORM\Column(name="enclosure", type="string", length=255, nullable=true)
     */
    private $enclosure;
	
    /**
     * @var string $link
     *
     * @ORM\Column(name="link", type="string", length=100, nullable=true)
     */
    private $link;
	
    /**
     * @var string $pubDate
     *
     * @ORM\Column(name="pubDate", type="string", length=100, nullable=true)
     */
    private $pubDate;
	
    /**
     * @var string $source
     *
     * @ORM\Column(name="source", type="string", length=100, nullable=true)
     */
    private $source;
	
    /**
     * @var string $avatar
     *
     * @ORM\Column(name="avatar", type="string", length=100, nullable=true)
     */
    private $avatar;
	
    /**
     * @var string $image
     *
     * @ORM\Column(name="image", type="string", length=255, nullable=true)
     */
    private $image;
	
    /**
     * @var string $accroche
     *
     * @ORM\Column(name="accroche", type="string", length=1024, nullable=true)
     */
    private $accroche;

    /**
     * @var \DateTime $creationDate
     *
     * @ORM\Column(name="created", type="datetime", nullable=false)
     */
    private $creationDate;

    /**
     * @var \DateTime $updateDate
     *
     * @ORM\Column(name="updated", type="datetime", nullable=true)
     */
    private $updateDate;
		

    /**
     * Constructor
     */
    public function __construct()
    {

    }
}