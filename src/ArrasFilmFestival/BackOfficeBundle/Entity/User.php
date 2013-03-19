<?php

namespace ArrasFilmFestival\BackOfficeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * User
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class User
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
     * @ORM\Column(name="login", type="string", length=255)
     */
    private $login;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="surname", type="string", length=255)
     */
    private $surname;

    /**
     * @ORM\ManyToOne(targetEntity="Team", inversedBy="users")
     * @ORM\JoinColumn(name="team_id", referencedColumnName="id")
     */
    private $team;

    /**
     * @ORM\OneToMany(targetEntity="Photo", mappedBy="user")
     */
    private $photos;

    /**
     * @ORM\OneToMany(targetEntity="Photo", mappedBy="user_update")
     */
    private $photos_update;

    /**
     * @ORM\OneToMany(targetEntity="Podcast", mappedBy="user")
     */
    private $podcasts;

    /**
     * @ORM\OneToMany(targetEntity="Podcast", mappedBy="user_update")
     */
    private $podcasts_update;

    /**
     * @ORM\OneToMany(targetEntity="Video", mappedBy="user")
     */
    private $videos;

    /**
     * @ORM\OneToMany(targetEntity="Video", mappedBy="user_update")
     */
    private $videos_update;

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
     * Set password
     *
     * @param string $password
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;
    
        return $this;
    }

    /**
     * Get password
     *
     * @return string 
     */
    public function getPassword()
    {
        return $this->password;
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
     * Constructor
     */
    public function __construct()
    {
        $this->medias = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Set team
     *
     * @param \ArrasFilmFestival\BackOfficeBundle\Entity\Team $team
     * @return User
     */
    public function setTeam(\ArrasFilmFestival\BackOfficeBundle\Entity\Team $team = null)
    {
        $this->team = $team;
    
        return $this;
    }

    /**
     * Get team
     *
     * @return \ArrasFilmFestival\BackOfficeBundle\Entity\Team 
     */
    public function getTeam()
    {
        return $this->team;
    }

    /**
     * Add medias
     *
     * @param \ArrasFilmFestival\BackOfficeBundle\Entity\Media $medias
     * @return User
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
     * Add photos_update
     *
     * @param \ArrasFilmFestival\BackOfficeBundle\Entity\Photo $photosUpdate
     * @return User
     */
    public function addPhotosUpdate(\ArrasFilmFestival\BackOfficeBundle\Entity\Photo $photosUpdate)
    {
        $this->photos_update[] = $photosUpdate;
    
        return $this;
    }

    /**
     * Remove photos_update
     *
     * @param \ArrasFilmFestival\BackOfficeBundle\Entity\Photo $photosUpdate
     */
    public function removePhotosUpdate(\ArrasFilmFestival\BackOfficeBundle\Entity\Photo $photosUpdate)
    {
        $this->photos_update->removeElement($photosUpdate);
    }

    /**
     * Get photos_update
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPhotosUpdate()
    {
        return $this->photos_update;
    }

    /**
     * Add podcasts_update
     *
     * @param \ArrasFilmFestival\BackOfficeBundle\Entity\Podcast $podcastsUpdate
     * @return User
     */
    public function addPodcastsUpdate(\ArrasFilmFestival\BackOfficeBundle\Entity\Podcast $podcastsUpdate)
    {
        $this->podcasts_update[] = $podcastsUpdate;
    
        return $this;
    }

    /**
     * Remove podcasts_update
     *
     * @param \ArrasFilmFestival\BackOfficeBundle\Entity\Podcast $podcastsUpdate
     */
    public function removePodcastsUpdate(\ArrasFilmFestival\BackOfficeBundle\Entity\Podcast $podcastsUpdate)
    {
        $this->podcasts_update->removeElement($podcastsUpdate);
    }

    /**
     * Get podcasts_update
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPodcastsUpdate()
    {
        return $this->podcasts_update;
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
     * Add videos_update
     *
     * @param \ArrasFilmFestival\BackOfficeBundle\Entity\Video $videosUpdate
     * @return User
     */
    public function addVideosUpdate(\ArrasFilmFestival\BackOfficeBundle\Entity\Video $videosUpdate)
    {
        $this->videos_update[] = $videosUpdate;
    
        return $this;
    }

    /**
     * Remove videos_update
     *
     * @param \ArrasFilmFestival\BackOfficeBundle\Entity\Video $videosUpdate
     */
    public function removeVideosUpdate(\ArrasFilmFestival\BackOfficeBundle\Entity\Video $videosUpdate)
    {
        $this->videos_update->removeElement($videosUpdate);
    }

    /**
     * Get videos_update
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getVideosUpdate()
    {
        return $this->videos_update;
    }
}