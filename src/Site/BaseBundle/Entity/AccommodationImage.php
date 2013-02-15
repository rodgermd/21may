<?php

namespace Site\BaseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Table(name="images__accommodations")
 * @ORM\Entity()
 * @Vich\Uploadable
 */
class AccommodationImage extends BaseImage
{
  /**
   * @var UploadedFile $file
   * @Assert\File(
   *     maxSize="10M",
   *     mimeTypes={"image/png", "image/jpeg", "image/pjpeg"}
   * )
   * @Vich\UploadableField(mapping="accommodation", fileNameProperty="filename")
   */
  protected $file;

  /**
   * @var Accommodation $accommodation
   * @ORM\ManyToOne(targetEntity="Site\BaseBundle\Entity\Accommodation", inversedBy="images")
   * @ORM\JoinColumn(name="accommodation_id", referencedColumnName="id", onDelete="CASCADE")
   */
  private $accommodation;


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
}