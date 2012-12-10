<?php

namespace Site\BaseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Table(name="accommodations__images")
 * @ORM\Entity()
 * @Vich\Uploadable
 */
class AccommodationImage
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
   * @ORM\Column(name="stack_order", type="integer")
   */
  private $stack_order = 0;

  /**
   * @var string
   *
   * @ORM\Column(name="image_filename", type="string", length=40)
   */
  private $filename;

  /**
   * @var UploadedFile $file
   * @Assert\File(
   *     maxSize="10M",
   *     mimeTypes={"image/png", "image/jpeg", "image/pjpeg"}
   * )
   * @Vich\UploadableField(mapping="accommodation", fileNameProperty="image_filename")
   */
  private $file;

  /**
   * @var Accommodation $accommodation
   * @ORM\ManyToOne(targetEntity="Site\BaseBundle\Entity\Accommodation", inversedBy="images")
   * @ORM\JoinColumn(name="accommodation_id", referencedColumnName="id", onDelete="CASCADE")
   */
  private $accommodation;


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
   * Set accommodation
   *
   * @param \Site\BaseBundle\Entity\Accommodation $accommodation
   * @return AccommodationImage
   */
  public function setAccommodation(\Site\BaseBundle\Entity\Accommodation $accommodation = null)
  {
    $this->accommodation = $accommodation;

    return $this;
  }

  /**
   * Get accommodation
   *
   * @return \Site\BaseBundle\Entity\Accommodation
   */
  public function getAccommodation()
  {
    return $this->accommodation;
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
    return $this;
  }
}