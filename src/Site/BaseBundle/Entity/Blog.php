<?php

namespace Site\BaseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\Translatable\Translatable;

/**
 * Blog
 *
 * @ORM\Table(name="blogs")
 * @ORM\Entity(repositoryClass="Site\BaseBundle\Entity\BlogRepository")
 * @Gedmo\TranslationEntity(class="Site\BaseBundle\Entity\BlogTranslation")
 */
class Blog implements Translatable
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
   * @Gedmo\Translatable
   * @ORM\Column(name="title", type="string", length=255, nullable=true)
   */
  private $title;

  /**
   * @var string
   * @Gedmo\Translatable
   * @ORM\Column(name="content", type="text", nullable=true)
   */
  private $content;

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

  /**
   * @Gedmo\Slug(fields={"title"})
   * @ORM\Column(length=128, unique=true)
   */
  private $slug;

  /**
   * @ORM\OneToMany(targetEntity="Site\BaseBundle\Entity\BlogTranslation", mappedBy="object", cascade={"persist", "remove"})
   * @Assert\Valid(deep = true)
   */
  private $translations;

  /**
   * @ORM\OneToMany(targetEntity="Site\BaseBundle\Entity\BlogImage", mappedBy="blog", cascade={"persist", "remove"})
   * @ORM\OrderBy({"stack_order" = "ASC"})
   * @var array $images
   */
  private $images;

  /**
   * @Gedmo\Locale
   */
  private $locale;

  public function __construct()
  {
    $this->translations = new ArrayCollection();
    $this->images       = new ArrayCollection();
  }

  public function getTranslations()
  {
    return $this->translations;
  }

  public function addTranslation(BlogTranslation $t)
  {
    if (!$this->translations->contains($t)) {
      $this->translations[] = $t;
      $t->setObject($this);
    }

    return $this;
  }

  /**
   * Remove translations
   * @param BlogTranslation $translations
   * @return void
   */
  public function removeTranslation(BlogTranslation $translations)
  {
    $this->translations->removeElement($translations);
  }

  public function setTranslatableLocale($locale)
  {
    $this->locale = $locale;

    return $this;
  }

  public function getLocale()
  {
    return $this->locale;
  }

  /**
   * Gets string representation
   * @return string
   */
  public function __toString()
  {
    return $this->title ? : $this->id;
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
   * @return Blog
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
   * Set description
   *
   * @param string $content
   * @return Blog
   */
  public function setContent($content)
  {
    $this->content = $content;

    return $this;
  }

  /**
   * Get description
   *
   * @return string
   */
  public function getContent()
  {
    return $this->content;
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

  /**
   * Gets slug
   * @return mixed
   */
  public function getSlug()
  {
    return $this->slug;
  }

  /**
   * Add images
   *
   * @param \Site\BaseBundle\Entity\BlogImage $image
   * @return Blog
   */
  public function addImage(\Site\BaseBundle\Entity\BlogImage $image)
  {
    $this->images[] = $image;
    $image->setBlog($this);
    return $this;
  }

  /**
   * Remove images
   *
   * @param \Site\BaseBundle\Entity\BlogImage $images
   */
  public function removeImage(\Site\BaseBundle\Entity\BlogImage $images)
  {
    $this->images->removeElement($images);
  }

  /**
   * Get images
   *
   * @return \Doctrine\Common\Collections\Collection
   */
  public function getImages()
  {
    return $this->images;
  }

  /**
   * Set created_at
   *
   * @param \DateTime $createdAt
   * @return Blog
   */
  public function setCreatedAt($createdAt)
  {
    $this->created_at = $createdAt;

    return $this;
  }

  /**
   * Set updated_at
   *
   * @param \DateTime $updatedAt
   * @return Blog
   */
  public function setUpdatedAt($updatedAt)
  {
    $this->updated_at = $updatedAt;

    return $this;
  }

  /**
   * Set slug
   *
   * @param string $slug
   * @return Blog
   */
  public function setSlug($slug)
  {
    $this->slug = $slug;

    return $this;
  }

}