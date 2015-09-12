<?php

namespace Site\BaseBundle\Model;

use Symfony\Component\Validator\Constraints as Assert;
use Site\BaseBundle\Entity\Accommodation;

/**
 * Class AccommodationContactModel
 *
 * @package Site\BaseBundle\Model
 */
class AccommodationContactModel extends ContactModel
{
    /** @var Accommodation */
    protected $accommodation;

    /**
     * Sets related accommodation
     *
     * @param Accommodation $accommodation
     *
     * @return $this
     */
    public function setAccommodation(Accommodation $accommodation)
    {
        $this->accommodation = $accommodation;

        return $this;
    }

    /**
     * Gets accommodation
     *
     * @return Accommodation
     */
    public function getAccommodation()
    {
        return $this->accommodation;
    }


}