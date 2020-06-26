<?php

namespace App\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SlideRepository")
 * @Vich\Uploadable
 */
class Slide
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * 
     * @Vich\UploadableField(mapping="slides_un", fileNameProperty="imageNameUn")
     * 
     * @var File
     */
    private $imageFileUn;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @var string
     */
    private $imageNameUn;
    
    /**
     * 
     * @Vich\UploadableField(mapping="slides_deux", fileNameProperty="imageNameDeux")
     * 
     * @var File
     */
    private $imageFileDeux;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @var string
     */
    private $imageNameDeux;
    
    /**
     * 
     * @Vich\UploadableField(mapping="slides_trois", fileNameProperty="imageNameTrois")
     * 
     * @var File
     */
    private $imageFileTrois;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @var string
     */
    private $imageNameTrois;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $alt;

    /**
     * @ORM\Column(type="datetime")
     */
    private $creted_at;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updateUnAt;
    
    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updateDeuxAt;
    
    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updateTroisAt;

    public function __construct()
    {
        $this->creted_at = new DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAlt(): ?string
    {
        return $this->alt;
    }

    public function setAlt(string $alt): self
    {
        $this->alt = $alt;

        return $this;
    }

    public function getCretedAt(): ?\DateTimeInterface
    {
        return $this->creted_at;
    }

    public function setCretedAt(\DateTimeInterface $creted_at): self
    {
        $this->creted_at = $creted_at;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get the value of imageFileUn
     *
     * @return  File
     */ 
    public function getImageFileUn()
    {
        return $this->imageFileUn;
    }

    /**
     * Set the value of imageFileUn
     *
     * @param  File  $imageFileUn
     *
     * @return  self
     */ 
    public function setImageFileUn(File $imageFileUn)
    {
        $this->imageFileUn = $imageFileUn;
        if ($this->imageFileUn instanceof UploadedFile) {
            $this->updateUnAt = new DateTime('now');
        }

        return $this;
    }

    /**
     * Get the value of imageNameUn
     *
     * @return  string
     */ 
    public function getImageNameUn()
    {
        return $this->imageNameUn;
    }

    /**
     * Set the value of imageNameUn
     *
     * @param  string  $imageNameUn
     *
     * @return  self
     */ 
    public function setImageNameUn(string $imageNameUn)
    {
        $this->imageNameUn = $imageNameUn;

        return $this;
    }

    /**
     * Get the value of imageFileDeux
     *
     * @return  File
     */ 
    public function getImageFileDeux()
    {
        return $this->imageFileDeux;
    }

    /**
     * Set the value of imageFileDeux
     *
     * @param  File  $imageFileDeux
     *
     * @return  self
     */ 
    public function setImageFileDeux(File $imageFileDeux)
    {
        $this->imageFileDeux = $imageFileDeux;
        if ($this->imageFileDeux instanceof UploadedFile) {
            $this->updateDeuxAt = new DateTime('now');
        }

        return $this;
    }

    /**
     * Get the value of imageNameDeux
     *
     * @return  string
     */ 
    public function getImageNameDeux()
    {
        return $this->imageNameDeux;
    }

    /**
     * Set the value of imageNameDeux
     *
     * @param  string  $imageNameDeux
     *
     * @return  self
     */ 
    public function setImageNameDeux(string $imageNameDeux)
    {
        $this->imageNameDeux = $imageNameDeux;

        return $this;
    }

    /**
     * Get the value of imageFileTrois
     *
     * @return  File
     */ 
    public function getImageFileTrois()
    {
        return $this->imageFileTrois;
    }

    /**
     * Set the value of imageFileTrois
     *
     * @param  File  $imageFileTrois
     *
     * @return  self
     */ 
    public function setImageFileTrois(File $imageFileTrois)
    {
        $this->imageFileTrois = $imageFileTrois;
        if ($this->imageFileTrois instanceof UploadedFile) {
            $this->updateTroisAt = new \DateTime('now');
        }

        return $this;
    }

    /**
     * Get the value of imageNameTrois
     *
     * @return  string
     */ 
    public function getImageNameTrois()
    {
        return $this->imageNameTrois;
    }

    /**
     * Set the value of imageNameTrois
     *
     * @param  string  $imageNameTrois
     *
     * @return  self
     */ 
    public function setImageNameTrois(string $imageNameTrois)
    {
        $this->imageNameTrois = $imageNameTrois;

        return $this;
    }

    /**
     * Get the value of updateUnAt
     */ 
    public function getUpdateUnAt()
    {
        return $this->updateUnAt;
    }

    /**
     * Set the value of updateUnAt
     *
     * @return  self
     */ 
    public function setUpdateUnAt($updateUnAt)
    {
        $this->updateUnAt = $updateUnAt;

        return $this;
    }

    /**
     * Get the value of updateDeuxAt
     */ 
    public function getUpdateDeuxAt()
    {
        return $this->updateDeuxAt;
    }

    /**
     * Set the value of updateDeuxAt
     *
     * @return  self
     */ 
    public function setUpdateDeuxAt($updateDeuxAt)
    {
        $this->updateDeuxAt = $updateDeuxAt;

        return $this;
    }

    /**
     * Get the value of updateTroisAt
     */ 
    public function getUpdateTroisAt()
    {
        return $this->updateTroisAt;
    }

    /**
     * Set the value of updateTroisAt
     *
     * @return  self
     */ 
    public function setUpdateTroisAt($updateTroisAt)
    {
        $this->updateTroisAt = $updateTroisAt;

        return $this;
    }

    public function __toString()
    {
        return $this->imageNameUn = $this->imageNameDeux = $this->imageNameTrois;
    }
}
