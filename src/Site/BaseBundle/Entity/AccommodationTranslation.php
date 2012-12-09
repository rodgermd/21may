<?php

namespace Site\BaseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Translatable\Entity\MappedSuperclass\AbstractPersonalTranslation;

/**
 * @ORM\Entity
 * @ORM\Table(name="accommodation__translations",
 *     uniqueConstraints={@ORM\UniqueConstraint(name="lookup_unique_idx", columns={
 *         "locale", "object_id", "field"
 *     })}
 * )
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
  public function __construct($locale, $field, $value)
  {
    $this->setLocale($locale);
    $this->setField($field);
    $this->setContent($value);
  }

  /**
   * @ORM\ManyToOne(targetEntity="Accommodation", inversedBy="translations")
   * @ORM\JoinColumn(name="object_id", referencedColumnName="id", onDelete="CASCADE")
   */
  protected $object;
}