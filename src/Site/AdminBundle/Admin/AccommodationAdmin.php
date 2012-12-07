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
    $subject = $form->getAdmin()->getSubject();
    $form
      ->add('title')
      ->add('file', 'image_file', array(
      'filter' => 'accomodation_small',
      'required'   => false,
      'use_delete' => $subject->getImageFilename(),
      'method'     => 'getImageFilename'
    ))
      ->add('description', 'textarea', array('required' => false))
      ->add('secondary_text', 'textarea', array('required' => false));
  }

}