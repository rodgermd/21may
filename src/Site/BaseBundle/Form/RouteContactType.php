<?php

namespace Site\BaseBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class RouteContactType extends ContactType
{
  public function setDefaultOptions(OptionsResolverInterface $resolver)
  {
    $resolver->replaceDefaults(array('data_class' => 'Site\BaseBundle\Model\RouteContactModel'));
  }

  public function getName() {
    return 'book_route';
  }
}