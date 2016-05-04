<?php

namespace Leczymy\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * Blog
 *
 * @ORM\Table(name="blog")
 * @ORM\Entity(repositoryClass="Leczymy\BlogBundle\Repository\BlogRepository")
 */
class Blog
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=200)
	 * 
	 * @Assert\NotBlank
     * @Assert\Length(
     *      max = 200
     * )	
	 * 
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
	 * @Assert\NotBlank
     * @Assert\Length(
     *      min = 100
     * )	 
	 * 
     */
    private $description;

    /**
     * @var \DateTime
     * 
     * @ORM\Column(name="createDate", type="datetime")
     */
    private $createDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="publicateDate", type="datetime", nullable=true)
     */
    private $publicateDate = null;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Blog
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
     * Set description
     *
     * @param string $description
     *
     * @return Blog
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
     * Set createDate
     *
     * @param \DateTime $createDate
     *
     * @return Blog
     */
    public function setCreateDate($createDate)
    {
        $this->createDate = $createDate;

        return $this;
    }

    /**
     * Get createDate
     *
     * @return \DateTime
     */
    public function getCreateDate()
    {
        return $this->createDate;
    }
	
	
    /**
     * Set publicateDate
     *
     * @param \DateTime $publicateDate
     *
     * @return Blog
     */
    public function setPublicateDate($publicateDate)
    {
        $this->publicateDate = $publicateDate;

        return $this;
    }

    /**
     * Get publicateDate
     *
     * @return \DateTime
     */
    public function getPublicateDate()
    {
        return $this->publicateDate;
    }	
	
	
}

