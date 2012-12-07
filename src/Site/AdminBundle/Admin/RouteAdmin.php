<?php
namespace Site\AdminBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;

class RouteAdmin extends Admin
{
  protected function configureListFields(ListMapper $list) // optional
  {
    $list->addIdentifier('title');
  }

  protected function configureFormFields(FormMapper $form)
  {
    $form
      ->add('title')
      ->add('program')
      ->add('iframe_code')
    ;
  }

}