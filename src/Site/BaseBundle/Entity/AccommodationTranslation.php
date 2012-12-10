<?php

namespace Site\BaseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Translatable\Entity\MappedSuperclass\AbstractPersonalTranslation;

/**
 * @ORM\Table(name="accommodation__translations", indexes={
 *      @ORM\Index(name="translations_idx", columns={"locale", "object_id", "field"})
 * })
 * @ORM\Entity()
 * @ORM\HasLifecycleCallbacks
 */
class AccommodationTranslation extends AbstractPersonalTranslation
{
  /**
   * Convinient constructor
   *
   * @param string $locale
   * @param string $field
   * @param string $value
   */
  public function __construct($locale = null, $field = null, $value = null)
  {
    $this->setLocale($locale);
    $this->setField($field);
    $this->setContent($value);
  }

  /**
   * @var \Site\BaseBundle\Entity\Accommodation $object
   * @ORM\ManyToOne(targetEntity="Site\BaseBundle\Entity\Accommodation", inversedBy="translations")
   * @ORM\JoinColumn(name="object_id", referencedColumnName="id", onDelete="CASCADE")
   */
  protected $object;

  /**
   * @ORM\PrePersist
   */
  public function updateParentFields()
  {
    if ($this->object->getLocale() == $this->locale)
    {
      $method = 'set' . ucfirst($this->field);
      if (method_exists($this->object, $method))
      {
        $this->object->$method($this->getContent());
      }
    }
  }
}