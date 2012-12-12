<?php

namespace Site\BaseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Doctrine\Common\Collections\ArrayCollection;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\Translatable\Translatable;

/**
 * Accommodation
 *
 * @ORM\Table(name="accommodations")
 * @ORM\Entity(repositoryClass="Site\BaseBundle\Entity\AccommodationRepository")
 * @Vich\Uploadable
 * @Gedmo\TranslationEntity(class="Site\BaseBundle\Entity\AccommodationTranslation")
 */
class Accommodation implements Translatable
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
   *
   * @ORM\Column(name="image_filename", type="string", length=40, nullable=true)
   */
  private $image_filename;

  /**
   * @var string
   * @Gedmo\Translatable
   * @ORM\Column(name="description", type="text", nullable=true)
   */
  private $description;

  /**
   * @var string
   * @Gedmo\Translatable
   * @ORM\Column(name="secondary_text", type="text", nullable=true)
   */
  private $secondary_text;

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
   * @var UploadedFile $file
   * @Assert\File(
   *     maxSize="10M",
   *     mimeTypes={"image/png", "image/jpeg", "image/pjpeg"}
   * )
   * @Vich\UploadableField(mapping="accommodation", fileNameProperty="image_filename")
   */
  private $file;

  /**
   * @ORM\OneToMany(targetEntity="Site\BaseBundle\Entity\AccommodationTranslation", mappedBy="object", cascade={"persist", "remove"})
   * @Assert\Valid(deep = true)
   */
  private $translations;

  /**
   * @ORM\OneToMany(targetEntity="Site\BaseBundle\Entity\AccommodationImage", mappedBy="accommodation", cascade={"persist", "remove"})
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
    $this->images = new ArrayCollection();
  }

  public function getTranslations()
  {
    return $this->translations;
  }

  public function addTranslation(AccommodationTranslation $t)
  {
    if (!$this->translations->contains($t)) {
      $this->translations[] = $t;
      $t->setObject($this);
    }

    return $this;
  }

  /**
   * Remove translations
   * @param AccommodationTranslation $translations
   * @return void
   */
  public function removeTranslation(AccommodationTranslation $translations)
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
    return $this->title ?: $this->id;
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
   * Sets uploaded file
   * @param \Symfony\Component\HttpFoundation\File\UploadedFile $file
   * @return Accommodation
   */
  public function setFile(UploadedFile $file)
  {
    $this->file = $file;
    $this->setUpdatedAt(new \DateTime());
    return $this;
  }

  /**
   * Gets uploaded file
   * @return \Symfony\Component\HttpFoundation\File\UploadedFile
   */
  public function getFile()
  {
    return $this->file;
  }


  /**
   * Add images
   *
   * @param \Site\BaseBundle\Entity\AccommodationImage $image
   * @return Accommodation
   */
  public function addImage(\Site\BaseBundle\Entity\AccommodationImage $image)
  {
    $this->images[] = $image;
    $image->setAccommodation($this);
    return $this;
  }

  /**
   * Remove images
   *
   * @param \Site\BaseBundle\Entity\AccommodationImage $images
   */
  public function removeImage(\Site\BaseBundle\Entity\AccommodationImage $images)
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
}