<?php

namespace ArrasFilmFestival\BackOfficeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Podcast
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class Podcast
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
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text")
     */
    private $content;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created", type="datetime")
     */
    private $created;

    /**
     * @var string
     *
     * @ORM\Column(name="path", type="string", length=255)
     */
    private $path;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated", type="datetime")
     */    
    private $updated;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="Podcasts")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    /**
     * @Assert\File(
     *     maxSize = "30720k",
     *     maxSizeMessage = "Le fichier ne doit pas dépasser 30Mo, veuillez en choisir un autre.",
     *     mimeTypes = {"audio/mpeg"},
     *     mimeTypesMessage = "Les fichiers doivent impérativement être au format mp3."
     * )
     */
    private $audio;

    /**
    * @var boolean
    *
    * @ORM\Column(name="isEnabled", type="boolean")
    */
    private $validate;

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
     * Set title
     *
     * @param string $title
     * @return Podcast
     */
    public function setTitle($title)
    {
        $this->title = $title;
    
        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set content
     *
     * @param string $content
     * @return Podcast
     */
    public function setContent($content)
    {
        $this->content = $content;
    
        return $this;
    }

    /**
     * Get content
     *
     * @return string 
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return Podcast
     */
    public function setCreated($created)
    {
        $this->created = $created;
    
        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime 
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set path
     *
     * @param string $path
     * @return Podcast
     */
    public function setPath($path)
    {
        $this->path = $path;
    
        return $this;
    }

    /**
     * Get path
     *
     * @return string 
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Set user
     *
     * @param \ArrasFilmFestival\BackOfficeBundle\Entity\User $user
     * @return Podcast
     */
    public function setUser(\ArrasFilmFestival\BackOfficeBundle\Entity\User $user = null)
    {
        $this->user = $user;
    
        return $this;
    }

    /**
     * Get user
     *
     * @return \ArrasFilmFestival\BackOfficeBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }


    /**
     * Set updated
     *
     * @param \DateTime $updated
     * @return Podcast
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;
    
        return $this;
    }

    /**
     * Get updated
     *
     * @return \DateTime 
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * Get updated
     *
     * @return File
     */
    public function getAudio()
    {
        return $this->audio;
    }

    /**
     * Set updated
     *
     * @param File
     * @return Podcast
     */
    public function setAudio($audio)
    {
        $this->audio = $audio;
    
        return $this;
    }

    public function getAbsolutePath()
    {
        return null === $this->path
            ? null
            : $this->getUploadRootDir().'/'.$this->path;
    }

    public function getWebPath()
    {
        return null === $this->path
            ? null
            : $this->getUploadDir().'/'.$this->path;
    }

    protected function getUploadRootDir()
    {
        return __DIR__.'/../../../../web/'.$this->getUploadDir();
    }

    /**
     * @ORM\PreRemove()
     */
    public function storeFilenameForRemove()
    {
        $this->filenameForRemove = $this->getAbsolutePath();
    }

    protected function getUploadDir()
    {
        return 'uploads/audios';
    }

    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function preUpload()
    {
        if (null !== $this->audio) {
            $audioname = sha1(uniqid(mt_rand(), true));
            $this->path = $audioname.'.'.$this->audio->guessExtension();
        }
    }

    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function upload()
    {
        if (null === $this->audio) {
            return;
        }

        $this->audio->move($this->getUploadRootDir(), $this->path);

        unset($this->audio);
    }

    /**
     * @ORM\PostRemove()
     */
    public function removeUpload()
    {
        if ($audio = $this->getAbsolutePath()) {
            unlink($audio);
        }
    }

    /**
     * Set user_update
     *
     * @param \ArrasFilmFestival\BackOfficeBundle\Entity\User $userUpdate
     * @return Podcast
     */
    public function setUserUpdate(\ArrasFilmFestival\BackOfficeBundle\Entity\User $userUpdate = null)
    {
        $this->user_update = $userUpdate;
    
        return $this;
    }

    /**
     * Get user_update
     *
     * @return \ArrasFilmFestival\BackOfficeBundle\Entity\User 
     */
    public function getUserUpdate()
    {
        return $this->user_update;
    }

    /**
     * Set validate
     *
     * @param boolean $validate
     * @return Podcast
     */
    public function setValidate($validate)
    {
        $this->validate = $validate;
    
        return $this;
    }

    /**
     * Get validate
     *
     * @return boolean 
     */
    public function getValidate()
    {
        return $this->validate;
    }
}