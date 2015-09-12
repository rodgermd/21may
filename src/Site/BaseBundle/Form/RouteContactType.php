<?php

namespace Site\BaseBundle\Form;

use Site\BaseBundle\Model\RouteContactModel;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Class RouteContactType
 *
 * @package Site\BaseBundle\Form
 */
class RouteContactType extends ContactType
{
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array('data_class' => RouteContactModel::class));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'book_route';
    }
}