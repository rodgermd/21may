<?php

namespace Site\BaseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * @ORM\Table(name="images__about_us")
 * @ORM\Entity()
 * @Vich\Uploadable
 */
class AboutUsImage extends BaseImage
{
  /**
   * @var UploadedFile $file
   * @Assert\File(maxSize="10M")
   * @Assert\Image
   * @Vich\UploadableField(mapping="galleries", fileNameProperty="filename")
   */
  protected  $file;
}