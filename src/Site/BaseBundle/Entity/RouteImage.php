<?php

namespace Site\BaseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Table(name="images__routes")
 * @ORM\Entity()
 * @Vich\Uploadable
 */
class RouteImage extends BaseImage
{

  /**
   * @var UploadedFile $file
   * @Assert\File(
   *     maxSize="10M",
   *     mimeTypes={"image/png", "image/jpeg", "image/pjpeg"}
   * )
   * @Vich\UploadableField(mapping="route", fileNameProperty="filename")
   */
  protected $file;

  /**
   * @var Accommodation $accommodation
   * @ORM\ManyToOne(targetEntity="Site\BaseBundle\Entity\Route", inversedBy="images")
   * @ORM\JoinColumn(name="route_id", referencedColumnName="id", onDelete="CASCADE")
   */
  private $route;

  /**
   * Set Route
   *
   * @param \Site\BaseBundle\Entity\Route $route
   * @return AccommodationImage
   */
  public function setRoute(\Site\BaseBundle\Entity\Route $route = null)
  {
    $this->route = $route;

    return $this;
  }

  /**
   * Get Route
   *
   * @return \Site\BaseBundle\Entity\Route
   */
  public function getRoute()
  {
    return $this->route;
  }

}