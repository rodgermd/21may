<?php

namespace Site\BaseBundle\Form;

use Site\BaseBundle\Model\AccommodationContactModel;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Class AccommodationContactType
 *
 * @package Site\BaseBundle\Form
 */
class AccommodationContactType extends ContactType
{
    /**
     * Sets default options
     *
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array('data_class' => AccommodationContactModel::class));
    }

    /**
     * Gets name
     *
     * @return string
     */
    public function getName()
    {
        return 'book_accommodation';
    }
}