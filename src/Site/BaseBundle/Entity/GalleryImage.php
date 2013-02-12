<?php

namespace Site\BaseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Table(name="gallery_images")
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\Entity()
 * @ORM\DiscriminatorColumn(name="gallery", type="string")
 * @ORM\DiscriminatorMap({"aboutus" = "AboutUsImage"})
 * @Vich\Uploadable
 */
class GalleryImage
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
   * @ORM\Column(name="title", type="string", length=128, nullable=true)
   * @var string $title
   */
  private $title;

  /**
   * @var string
   * @ORM\Column(name="stack_order", type="integer")
   */
  private $stack_order = 0;

  /**
   * @var string
   *
   * @ORM\Column(name="filename", type="string", length=40)
   */
  protected $filename;

  /**
   * @var \DateTime
   * @Gedmo\Timestampable(on="create")
   * @ORM\Column(name="created_at", type="datetime")
   */
  private $created_at;

  /**
   * @var \DateTime
   * @Gedmo\Timestampable(on="update")
   * @ORM\Column(name="updated_at", type="datetime")
   */
  private $updated_at;

  protected $file;


  public function __toString()
  {
    return $this->title ?: $this->filename;
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
   * Set stack_order
   *
   * @param integer $stackOrder
   * @return AccommodationImage
   */
  public function setStackOrder($stackOrder)
  {
    $this->stack_order = $stackOrder;

    return $this;
  }

  /**
   * Get stack_order
   *
   * @return integer
   */
  public function getStackOrder()
  {
    return $this->stack_order;
  }

  /**
   * Gets title
   * @return string
   */
  public function getTitle()
  {
    return $this->title;
  }

  /**
   * Sets title
   * @param $title
   * @return \Site\BaseBundle\Entity\GalleryImage
   */
  public function setTitle($title)
  {
    $this->title = $title;

    return $this;
  }

  /**
   * Set filename
   *
   * @param string $filename
   * @return AccommodationImage
   */
  public function setFilename($filename)
  {
    $this->filename = $filename;

    return $this;
  }

  /**
   * Get filename
   *
   * @return string
   */
  public function getFilename()
  {
    return $this->filename;
  }

  /**
   * Gets file
   * @return \Symfony\Component\HttpFoundation\File\UploadedFile
   */
  public function getFile()
  {
    return $this->file;
  }

  /**
   * Sets file
   * @param \Symfony\Component\HttpFoundation\File\UploadedFile $file
   * @return AccommodationImage
   */
  public function setFile(UploadedFile $file)
  {
    $this->file = $file;
    $this->updated_at = null;
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
   * Get updated_at
   *
   * @return \DateTime
   */
  public function getUpdatedAt()
  {
    return $this->updated_at;
  }
}