<?php

namespace Site\BaseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * Accommodation
 *
 * @ORM\Table(name="accommodations")
 * @ORM\Entity(repositoryClass="Site\BaseBundle\Entity\AccommodationRepository")
 */
class Accommodation
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
   * @ORM\Column(name="image_filename", type="string", length=50)
   */
  private $image_filename;

  /**
   * @var string
   *
   * @ORM\Column(name="description", type="text")
   */
  private $description;

  /**
   * @var string
   *
   * @ORM\Column(name="secondary_text", type="text")
   */
  private $secondary_text;

  /**
   * @var \DateTime
   *
   * @ORM\Column(name="created_at", type="datetime")
   */
  private $created_at;

  /**
   * @var \DateTime
   *
   * @ORM\Column(name="updated_at", type="datetime")
   */
  private $updated_at;

  /**
   * @var UploadedFile $primary_image
   * @Assert\File(
   *     maxSize="10M",
   *     mimeTypes={"image/png", "image/jpeg", "image/pjpeg"}
   * )
   * @Vich\UploadableField(mapping="accomodation", fileNameProperty="image_filename")
   */
  private $primary_image;

  /**
   * Gets string representation
   * @return string
   */
  public function __toString()
  {
    return $this->title;
  }


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
   * @return Accommodation
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
   * Set image_filename
   *
   * @param string $imageFilename
   * @return Accommodation
   */
  public function setImageFilename($imageFilename)
  {
    $this->image_filename = $imageFilename;

    return $this;
  }

  /**
   * Get image_filename
   *
   * @return string
   */
  public function getImageFilename()
  {
    return $this->image_filename;
  }

  /**
   * Set description
   *
   * @param string $description
   * @return Accommodation
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
   * Set secondary_text
   *
   * @param string $secondaryText
   * @return Accommodation
   */
  public function setSecondaryText($secondaryText)
  {
    $this->secondary_text = $secondaryText;

    return $this;
  }

  /**
   * Get secondary_text
   *
   * @return string
   */
  public function getSecondaryText()
  {
    return $this->secondary_text;
  }

  /**
   * Set created_at
   *
   * @param \DateTime $createdAt
   * @return Route
   */
  public function setCreatedAt($createdAt)
  {
    $this->created_at = $createdAt;

    return $this;
  }

  /**
   * Get created_at
   *
   * @return \DateTime
   */
  public function getCreatedAt()
  {
    return $this->created_at;
  }

  /**
   * Set updated_at
   *
   * @param \DateTime $updatedAt
   * @return Route
   */
  public function setUpdatedAt($updatedAt)
  {
    $this->updated_at = $updatedAt;

    return $this;
  }

  /**
   * Get updated_at
   *
   * @return \DateTime
   */
  public function getUpdatedAt()
  {
    return $this->updated_at;
  }

  /**
   * Sets uploaded file
   * @param \Symfony\Component\HttpFoundation\File\UploadedFile $file
   * @return Accommodation
   */
  public function setFile(UploadedFile $file)
  {
    $this->primary_image = $file;
    $this->setUpdatedAt(new \DateTime());
    return $this;
  }

  /**
   * Gets uploaded file
   * @return \Symfony\Component\HttpFoundation\File\UploadedFile
   */
  public function getFile()
  {
    return $this->primary_image;
  }
}
