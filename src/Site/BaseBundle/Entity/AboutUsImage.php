<?php

namespace Site\BaseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity()
 * @Vich\Uploadable
 */
class AboutUsImage extends GalleryImage
{
  /**
   * @var UploadedFile $file
   * @Assert\File(
   *     maxSize="10M",
   *     mimeTypes={"image/png", "image/jpeg", "image/pjpeg"}
   * )
   * @Vich\UploadableField(mapping="galleries", fileNameProperty="filename")
   */
  protected  $file;
}