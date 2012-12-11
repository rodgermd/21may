<?php
namespace Site\AdminBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Site\BaseBundle\Entity\Accommodation;
use Site\BaseBundle\Entity\AccommodationTranslation;

class AccommodationImageAdmin extends Admin
{

  protected function configureListFields(ListMapper $list) // optional
  {
    $list
      ->addIdentifier('image_filename', null, array(
      'template' => 'SiteAdminBundle:AccommodationImageAdmin:list_image.html.twig',
      'label' => 'Image'
    ))
    ->add('accommodation')
    ;
  }

  protected function configureFormFields(FormMapper $form)
  {
    $form
      ->add('accommodation')
      ->add('file', 'image_file', array(
      'filter' => 'accommodation_admin_preview',
      'required'   => false,
      'method'     => 'getFilename'
    ));
  }
}