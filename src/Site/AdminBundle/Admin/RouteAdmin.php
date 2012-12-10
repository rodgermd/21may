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
    $form
      ->add('accomodation')
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
    ))

    ;
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

}