<?php

namespace Site\BaseBundle\Form;

use Site\BaseBundle\Model\ContactModel;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Class ContactType
 *
 * @package Site\BaseBundle\Form
 */
class ContactType extends AbstractType
{
    /**
     * Builds the form
     *
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('phone', null, array('required' => false))
            ->add('email', 'email')
            ->add('nationality', null, array('required' => false))
            ->add('message', 'textarea');
    }

    /**
     * Sets default options
     *
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array('data_class' => ContactModel::class));
    }

    /**
     * Gets name
     *
     * @return string
     */
    public function getName()
    {
        return 'contact';
    }
}