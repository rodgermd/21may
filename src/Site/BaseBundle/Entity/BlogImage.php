<?php

namespace Site\BaseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * @ORM\Table(name="images__blog")
 * @ORM\Entity()
 * @Vich\Uploadable
 */
class BlogImage extends BaseImage
{
  /**
   * @var UploadedFile $file
   * @Assert\File(maxSize="10M")
   * @Assert\Image
   * @Vich\UploadableField(mapping="blogs", fileNameProperty="filename")
   */
  protected  $file;

  /**
   * @var Blog $blog
   * @ORM\ManyToOne(targetEntity="Site\BaseBundle\Entity\Blog", inversedBy="images")
   * @ORM\JoinColumn(name="blog_id", referencedColumnName="id", onDelete="CASCADE")
   * @Assert\NotNull
   */
  private $blog;

  /**
   * Set blog
   *
   * @param \Site\BaseBundle\Entity\Blog $blog
   * @return BlogImage
   */
  public function setBlog(\Site\BaseBundle\Entity\Blog $blog)
  {
    $this->blog = $blog;

    return $this;
  }

  /**
   * Get blog
   *
   * @return \Site\BaseBundle\Entity\Blog
   */
  public function getBlog()
  {
    return $this->blog;
  }
}