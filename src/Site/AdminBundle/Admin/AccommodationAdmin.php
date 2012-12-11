<?php
namespace Site\AdminBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Site\BaseBundle\Entity\Accommodation;
use Site\BaseBundle\Entity\AccommodationTranslation;

class AccommodationAdmin extends Admin
{
  protected $languages;
  public function setAvailableLanguages(array $languages)
  {
    $this->languages = $languages;
  }

  protected function configureListFields(ListMapper $list) // optional
  {
    $list
      ->addIdentifier('title')
      ->add('image_filename', null, array(
      'template' => 'SiteAdminBundle:AccommodationAdmin:list_image.html.twig',
      'label' => 'Primary image'
    ))
    ->add('created_at', 'datetime')
    ->add('updated_at', 'datetime')
    ;
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

    if ($subject->getId()) $this->setTemplate('edit', 'SiteAdminBundle:AccommodationAdmin:edit.html.twig');
  }

  public function getNewInstance()
  {
    $object = parent::getNewInstance();
    $object->setTranslatableLocale($this->getRequest()->getLocale());
    foreach (array_keys($this->languages) as $culture) {
      $object->addTranslation(new AccommodationTranslation($culture, 'title'));
      $object->addTranslation(new AccommodationTranslation($culture, 'description'));
      $object->addTranslation(new AccommodationTranslation($culture, 'secondary_text'));
    }
    return $object;
  }

  public function prePersist($object)
  {
    $this->updateBaseTranslation($object);
  }

  public function preUpdate($object)
  {
    $this->updateBaseTranslation($object);
  }

  protected function updateBaseTranslation(Accommodation $accommodation)
  {
    $accommodation->setTranslatableLocale($this->getRequest()->getLocale());
    foreach($accommodation->getTranslations() as $translation)
    {
      /** @var AccommodationTranslation $translation */
      $translation->updateParentFields();
    }
  }

  public function getRoutes()
  {
    parent::getRoutes();
    $this->routes->add('upload_images', $this->getRouterIdParameter() . '/upload-images');
    $this->routes->add('order_images', $this->getRouterIdParameter() . '/order-images');
    return $this->routes;
  }
}