<?php
namespace Site\AdminBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;

use Site\BaseBundle\Entity\Route;
use Site\BaseBundle\Entity\RouteTranslation;

class RouteAdmin extends Admin
{
  protected $languages;
  public function setAvailableLanguages(array $languages)
  {
    $this->languages = $languages;
  }

  protected function configureListFields(ListMapper $list) // optional
  {
    $list->addIdentifier('title')->add('accomodation');
  }

  protected function configureFormFields(FormMapper $form)
  {
    $subject = $form->getAdmin()->getSubject();

    $form
      ->add('accommodation')
      ->add('iframe_code')
      ->add('translations', 'translatable_field', array(
      'personal_translation' => 'Site\BaseBundle\Entity\AccommodationTranslation',
      'fields' => array('title', 'program', 'additional'),
      'widgets' => array('title' => 'text', 'program' => 'textarea', 'additional' => 'textarea'),
      'field_options'  => array(
        'title' => array('label' => 'Title'),
        'program' => array('label' => 'Program', 'attr' => array('class' => 'tinymce', 'data-theme' => 'medium')),
        'additional' => array( 'label' => 'Additional', 'attr' => array('class' => 'tinymce', 'data-theme' => 'simple'))
      )
    ));

    if ($subject->getId()) $this->setTemplate('edit', 'SiteAdminBundle:RouteAdmin:edit.html.twig');
  }

  public function getNewInstance()
  {
    $object = parent::getNewInstance();
    $object->setTranslatableLocale($this->getRequest()->getLocale());
    foreach (array_keys($this->languages) as $culture) {
      $object->addTranslation(new RouteTranslation($culture, 'title'));
      $object->addTranslation(new RouteTranslation($culture, 'program'));
      $object->addTranslation(new RouteTranslation($culture, 'additional'));
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

  protected function updateBaseTranslation(Route $route)
  {
    $route->setTranslatableLocale($this->getRequest()->getLocale());
    foreach($route->getTranslations() as $translation)
    {
      /** @var RouteTranslation $translation */
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