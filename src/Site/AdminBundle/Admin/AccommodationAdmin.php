<?php
namespace Site\AdminBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Site\UserBundle\Entity\User;

class AccommodationAdmin extends Admin
{
  protected function configureListFields(ListMapper $list) // optional
  {
    $list->addIdentifier('title')->add('image_filename');
  }

  protected function configureFormFields(FormMapper $form)
  {
    $form
      ->add('title')
      ->add('primary_image')
      ->add('description')
      ->add('secondary_text')
    ;
  }

}