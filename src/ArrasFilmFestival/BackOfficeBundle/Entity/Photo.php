<?php

namespace ArrasFilmFestival\BackOfficeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Photo
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class Photo
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
     * @ORM\ManyToOne(targetEntity="User", inversedBy="photos")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    /**
     * @Assert\File(
     *     maxSize = "2048k",
     *     maxSizeMessage = "Les fichiers ne doivent pas dépasser 2 Mo.",  
     *     mimeTypes = {"image/png", "image/jpeg"},
     *     mimeTypesMessage = "Les fichiers doivent impérativement être au format png ou jpeg."
     * )
     */
    public $image;

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
     * @return Photo
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
     * @return Photo
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
     * @return Photo
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
     * @return Photo
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
     * @return Photo
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
     * @return Photo
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
     * Set photo
     *
     * @param \File $photo
     * @return Photo
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;
    
        return $this;
    }

    /**
     * Get photo
     *
     * @return \File
     */
    public function getPhoto()
    {
        return $this->photo;
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

    protected function getUploadDir()
    {
        return 'uploads/photos';
    }

    /**
     * @ORM\PreRemove()
     */
    public function storeFilenameForRemove()
    {
        $this->filenameForRemove = $this->getAbsolutePath();
    }

    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function preUpload()
    {
        if (null !== $this->image) {
            $imagename = sha1(uniqid(mt_rand(), true));
            $this->path = $imagename.'.'.$this->image->guessExtension();
        }
    }

    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function upload()
    {
        if (null === $this->image) {
            return;
        }

        $this->image->move($this->getUploadRootDir(), $this->path);

        unset($this->image);
    }

    /**
     * @ORM\PostRemove()
     */
    public function removeUpload()
    {
        if ($image = $this->getAbsolutePath()) {
            unlink($image);
        }
    }

    /**
     * Set validate
     *
     * @param boolean $validate
     * @return Photo
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