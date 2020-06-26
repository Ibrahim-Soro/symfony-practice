<?php

namespace App\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ImageRepository")
 * @Vich\Uploadable
 */
class Image
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * 
     */
    private $id;

    /**
     * @var File|null
     * @Vich\UploadableField(mapping="product_images", fileNameProperty="imageName")
     */
    private $imageFile;

    /**
     * @var string|null
     * @ORM\Column(type="string", length=255)
     */
    private $imageName;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdone_at;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updatedone_at;

    public function __construct()
    {
        $this->createdone_at = new DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Get the value of imageFile
     *
     * @return  File|null
     */ 
    public function getImageFile()
    {
        return $this->imageFile;
    }

    /**
     * Set the value of imageFile
     *
     * @param  File|null  $imageFile
     *
     * @return  self
     */ 
    public function setImageFile($imageFile)
    {
        $this->imageFile = $imageFile;
         if ($this->imageFile instanceof UploadedFile) {
            $this->updatedone_at = new DateTime('now');
        }

        return $this;
    }

    /**
     * Get the value of imageName
     *
     * @return  string|null
     */ 
    public function getImageName()
    {
        return $this->imageName;
    }

    /**
     * Set the value of imageName
     *
     * @param  string|null  $imageName
     *
     * @return  self
     */ 
    public function setImageName($imageName)
    {
        $this->imageName = $imageName;

        return $this;
    }

    public function getCreatedoneAt(): ?\DateTimeInterface
    {
        return $this->createdone_at;
    }

    public function setCreatedoneAt(\DateTimeInterface $createdone_at): self
    {
        $this->createdone_at = $createdone_at;

        return $this;
    }

    public function getUpdatedoneAt(): ?\DateTimeInterface
    {
        return $this->updatedone_at;
    }

    public function setUpdatedoneAt(?\DateTimeInterface $updatedone_at): self
    {
        $this->updatedone_at = $updatedone_at;

        return $this;
    }
}
