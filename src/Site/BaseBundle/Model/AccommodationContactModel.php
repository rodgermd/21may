<?php

namespace Site\BaseBundle\Model;
use Symfony\Component\Validator\Constraints as Assert;
use Site\BaseBundle\Entity\Accommodation;

class AccommodationContactModel extends ContactModel
{

  /**
   * @var Accommodation;
   * @Assert\NotBlank
   */
  protected $accommodation;


  /**
   * Gets Accommodation
   * @return \Site\BaseBundle\Entity\Accommodation
   */
  public function getAccommodation()
  {
    return $this->accommodation;
  }

  /**
   * Sets Accommodation
   * @param \Site\BaseBundle\Entity\Accommodation $accommodation
   * @return AccommodationContactModel
   */
  public function setAccommodation(Accommodation $accommodation)
  {
    $this->accommodation = $accommodation;

    return $this;
  }
}