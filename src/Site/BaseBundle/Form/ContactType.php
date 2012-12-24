<?php

namespace Site\BaseBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class ContactType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder
      ->add('name')
      ->add('phone', null, array('required' => false))
      ->add('email', 'email')
      ->add('nationality', null, array('required' => false))
      ->add('message', 'textarea')
    ;
  }

  public function getDefaultOptions(array $options)
  {
    $options['data_class'] = 'Site\BaseBundle\Model\ContactModel';
    return $options;
  }

  public function getName() {
    return 'contact';
  }
}