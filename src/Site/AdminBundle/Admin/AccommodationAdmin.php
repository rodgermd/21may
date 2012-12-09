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
      ->add('translations', 'translatable_field', array(
      'personal_translation' => 'Site\BaseBundle\Entity\AccommodationTranslation',
      'fields' => array('title', 'description', 'secondary_text'),
      'widgets' => array('title' => 'text', 'description' => 'textarea', 'secondary_text' => 'textarea'),
      'field_options'  => array(
        'title' => array('label' => 'Title'),
        'description' => array('label' => 'Description', 'attr' => array('class' => 'tinymce', 'data-theme' => 'simple')),
        'secondary_text' => array( 'label' => 'Second text', 'attr' => array('class' => 'tinymce', 'data-theme' => 'medium'))
      )
    ))
      ->add('file', 'image_file', array(
      'filter' => 'accommodation_admin_preview',
      'required'   => false,
      'use_delete' => $subject->getImageFilename(),
      'method'     => 'getImageFilename'
    ));

    $this->setTemplate('edit', 'SiteAdminBundle::edit.html.twig');
  }
}