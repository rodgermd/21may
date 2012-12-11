<?php
namespace Site\AdminBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Site\BaseBundle\Entity\Accommodation;
use Site\BaseBundle\Entity\AccommodationTranslation;

class RouteImageAdmin extends Admin
{

  protected function configureListFields(ListMapper $list) // optional
  {
    $list
      ->addIdentifier('filename', null, array(
      'template' => 'SiteAdminBundle:RouteImageAdmin:list_image.html.twig',
      'label' => 'Image'
    ))
    ->add('route')
    ;
  }

  protected function configureFormFields(FormMapper $form)
  {
    $form
      ->add('route')
      ->add('file', 'image_file', array(
      'filter' => 'accommodation_admin_preview',
      'required'   => false,
      'method'     => 'getFilename'
    ));
  }
}