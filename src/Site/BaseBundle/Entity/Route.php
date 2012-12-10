<?php

namespace Site\BaseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Route
 *
 * @ORM\Table(name="routes")
 * @ORM\Entity(repositoryClass="Site\BaseBundle\Entity\RouteRepository")
 * @Gedmo\TranslationEntity(class="Site\BaseBundle\Entity\RouteTranslation")
 */
class Route
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
   * @ORM\Column(name="title", type="string", length=255)
   */
  private $title;

  /**
   * @var string
   * @Gedmo\Translatable
   * @ORM\Column(name="program", type="text", nullable=true)
   */
  private $program;

  /**
   * @var string
   * @Gedmo\Translatable
   * @ORM\Column(name="additional", type="text", nullable=true)
   */
  private $additional;

  /**
   * @var string
   *
   * @ORM\Column(name="iframe_code", type="text", nullable=true)
   */
  private $iframe_code;

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
   * @ORM\OneToMany(targetEntity="Site\BaseBundle\Entity\RouteTranslation", mappedBy="object", cascade={"persist", "remove"})
   * @Assert\Valid(deep = true)
   */
  private $translations;

  /**
   * @ORM\OneToMany(targetEntity="Site\BaseBundle\Entity\RouteImage", mappedBy="route", cascade={"persist", "remove"})
   * @var array $images
   */
  private $images;

  /**
   * @var Accommodation $accommodation
   * @ORM\ManyToOne(targetEntity="Site\BaseBundle\Entity\Accommodation", inversedBy="routes")
   * @ORM\JoinColumn(name="accommodation_id", referencedColumnName="id", onDelete="CASCADE")
   * @Assert\NotBlank()
   */
  private $accomodation;

  /**
   * @Gedmo\Locale
   */
  private $locale;

  public function __construct()
  {
    $this->images       = new ArrayCollection();
    $this->translations = new ArrayCollection();
  }

  /**
   * Gets translations
   * @return \Doctrine\Common\Collections\ArrayCollection
   */
  public function getTranslations()
  {
    return $this->translations;
  }

  /**
   * Adds translation into collection
   * @param RouteTranslation $t
   * @return Route
   */
  public function addTranslation(RouteTranslation $t)
  {
    if (!$this->translations->contains($t)) {
      $this->translations[] = $t;
      $t->setObject($this);
    }

    return $this;
  }

  /**
   * Remove translations
   * @param RouteTranslation $translations
   * @return void
   */
  public function removeTranslation(RouteTranslation $translations)
  {
    $this->translations->removeElement($translations);
  }

  /**
   * Sets translatable locale
   * @param $locale
   * @return Route
   */
  public function setTranslatableLocale($locale)
  {
    $this->locale = $locale;

    return $this;
  }

  /**
   * Gets current locale
   * @return string
   */
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
   * @return Route
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
   * Set program
   *
   * @param string $program
   * @return Route
   */
  public function setProgram($program)
  {
    $this->program = $program;

    return $this;
  }

  /**
   * Get program
   *
   * @return string
   */
  public function getProgram()
  {
    return $this->program;
  }

  /**
   * Set iframe_code
   *
   * @param string $iframeCode
   * @return Route
   */
  public function setIframeCode($iframeCode)
  {
    $this->iframe_code = $iframeCode;

    return $this;
  }

  /**
   * Get iframe_code
   *
   * @return string
   */
  public function getIframeCode()
  {
    return $this->iframe_code;
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
   * Set additional
   *
   * @param string $additional
   * @return Route
   */
  public function setAdditional($additional)
  {
    $this->additional = $additional;

    return $this;
  }

  /**
   * Get additional
   *
   * @return string
   */
  public function getAdditional()
  {
    return $this->additional;
  }

  /**
   * Add images
   *
   * @param \Site\BaseBundle\Entity\RouteImage $images
   * @return Route
   */
  public function addImage(\Site\BaseBundle\Entity\RouteImage $images)
  {
    $this->images[] = $images;

    return $this;
  }

  /**
   * Remove images
   *
   * @param \Site\BaseBundle\Entity\RouteImage $images
   */
  public function removeImage(\Site\BaseBundle\Entity\RouteImage $images)
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
   * Set accomodation
   *
   * @param \Site\BaseBundle\Entity\Accommodation $accomodation
   * @return Route
   */
  public function setAccomodation(\Site\BaseBundle\Entity\Accommodation $accomodation = null)
  {
    $this->accomodation = $accomodation;

    return $this;
  }

  /**
   * Get accomodation
   *
   * @return \Site\BaseBundle\Entity\Accommodation
   */
  public function getAccomodation()
  {
    return $this->accomodation;
  }
}