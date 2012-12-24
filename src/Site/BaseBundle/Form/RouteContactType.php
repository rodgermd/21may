<?php

namespace Site\BaseBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class RouteContactType extends ContactType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    parent::buildForm($builder, $options);
    $builder
      ->add('route', 'hidden')
    ;
  }

  public function getDefaultOptions(array $options)
  {
    $options['data_class'] = 'Site\BaseBundle\Model\RouteContactModel';
    return $options;
  }

  public function getName() {
    return 'book_route';
  }
}