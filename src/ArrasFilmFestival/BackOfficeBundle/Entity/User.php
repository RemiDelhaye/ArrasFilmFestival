<?php

namespace ArrasFilmFestival\BackOfficeBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * User
 *
 * @ORM\Table(name="fos_user")
 * @ORM\Entity
 */
class User extends BaseUser
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
   
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    protected $name;

    /**
     * @var string
     *
     * @ORM\Column(name="surname", type="string", length=255)
     */
    protected $surname;

    /**
     * @var string
     *
     * @ORM\Column(name="team", type="string", length=255)
     */
    protected $team;


    /**
     * @ORM\OneToMany(targetEntity="Photo", mappedBy="user", cascade={"remove"})
     */
    protected $photos;

    /**
     * @ORM\OneToMany(targetEntity="Podcast", mappedBy="user", cascade={"remove"})
     */
    protected $podcasts;

    /**
     * @ORM\OneToMany(targetEntity="Video", mappedBy="user", cascade={"remove"})
     */
    protected $videos;

    /**
     * @ORM\OneToMany(targetEntity="Article", mappedBy="user", cascade={"remove"})
     */
    protected $articles;

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
     * @return User
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
     * Set surname
     *
     * @param string $surname
     * @return User
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;
    
        return $this;
    }

    /**
     * Get surname
     *
     * @return string 
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * Add photos
     *
     * @param \ArrasFilmFestival\BackOfficeBundle\Entity\Photo $photos
     * @return User
     */
    public function addPhoto(\ArrasFilmFestival\BackOfficeBundle\Entity\Photo $photos)
    {
        $this->photos[] = $photos;
    
        return $this;
    }

    /**
     * Remove photos
     *
     * @param \ArrasFilmFestival\BackOfficeBundle\Entity\Photo $photos
     */
    public function removePhoto(\ArrasFilmFestival\BackOfficeBundle\Entity\Photo $photos)
    {
        $this->photos->removeElement($photos);
    }

    /**
     * Get photos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPhotos()
    {
        return $this->photos;
    }

    /**
     * Add podcasts
     *
     * @param \ArrasFilmFestival\BackOfficeBundle\Entity\Podcast $podcasts
     * @return User
     */
    public function addPodcast(\ArrasFilmFestival\BackOfficeBundle\Entity\Podcast $podcasts)
    {
        $this->podcasts[] = $podcasts;
    
        return $this;
    }

    /**
     * Remove podcasts
     *
     * @param \ArrasFilmFestival\BackOfficeBundle\Entity\Podcast $podcasts
     */
    public function removePodcast(\ArrasFilmFestival\BackOfficeBundle\Entity\Podcast $podcasts)
    {
        $this->podcasts->removeElement($podcasts);
    }

    /**
     * Get podcasts
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPodcasts()
    {
        return $this->podcasts;
    }

    /**
     * Add videos
     *
     * @param \ArrasFilmFestival\BackOfficeBundle\Entity\Video $videos
     * @return User
     */
    public function addVideo(\ArrasFilmFestival\BackOfficeBundle\Entity\Video $videos)
    {
        $this->videos[] = $videos;
    
        return $this;
    }

    /**
     * Remove videos
     *
     * @param \ArrasFilmFestival\BackOfficeBundle\Entity\Video $videos
     */
    public function removeVideo(\ArrasFilmFestival\BackOfficeBundle\Entity\Video $videos)
    {
        $this->videos->removeElement($videos);
    }

    /**
     * Get videos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getVideos()
    {
        return $this->videos;
    }

    /**
     * Set team
     *
     * @param string $team
     * @return User
     */
    public function setTeam($team)
    {
        $this->team = $team;
    
        return $this;
    }

    /**
     * Get team
     *
     * @return string 
     */
    public function getTeam()
    {
        return $this->team;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->photos = new \Doctrine\Common\Collections\ArrayCollection();
        $this->podcasts = new \Doctrine\Common\Collections\ArrayCollection();
        $this->videos = new \Doctrine\Common\Collections\ArrayCollection();
        $this->articles = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add articles
     *
     * @param \ArrasFilmFestival\BackOfficeBundle\Entity\Article $articles
     * @return User
     */
    public function addArticle(\ArrasFilmFestival\BackOfficeBundle\Entity\Article $articles)
    {
        $this->articles[] = $articles;
    
        return $this;
    }

    /**
     * Remove articles
     *
     * @param \ArrasFilmFestival\BackOfficeBundle\Entity\Article $articles
     */
    public function removeArticle(\ArrasFilmFestival\BackOfficeBundle\Entity\Article $articles)
    {
        $this->articles->removeElement($articles);
    }

    /**
     * Get articles
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getArticles()
    {
        return $this->articles;
    }
}