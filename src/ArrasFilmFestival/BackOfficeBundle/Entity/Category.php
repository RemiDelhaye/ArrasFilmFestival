<?php

namespace ArrasFilmFestival\BackOfficeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Category
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Category
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var boolean
     *
     * @ORM\Column(name="upload", type="boolean")
     */
    private $upload;

    /**
     * @ORM\OneToMany(targetEntity="Media", mappedBy="category")
     */
    private $medias;


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
     * Set name
     *
     * @param string $name
     * @return Category
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
     * Set upload
     *
     * @param boolean $upload
     * @return Category
     */
    public function setUpload($upload)
    {
        $this->upload = $upload;
    
        return $this;
    }

    /**
     * Get upload
     *
     * @return boolean 
     */
    public function getUpload()
    {
        return $this->upload;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->medias = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add medias
     *
     * @param \ArrasFilmFestival\BackOfficeBundle\Entity\Media $medias
     * @return Category
     */
    public function addMedia(\ArrasFilmFestival\BackOfficeBundle\Entity\Media $medias)
    {
        $this->medias[] = $medias;
    
        return $this;
    }

    /**
     * Remove medias
     *
     * @param \ArrasFilmFestival\BackOfficeBundle\Entity\Media $medias
     */
    public function removeMedia(\ArrasFilmFestival\BackOfficeBundle\Entity\Media $medias)
    {
        $this->medias->removeElement($medias);
    }

    /**
     * Get medias
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMedias()
    {
        return $this->medias;
    }
}