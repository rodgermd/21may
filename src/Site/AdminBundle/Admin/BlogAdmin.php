<?php
namespace Site\AdminBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Site\BaseBundle\Entity\Blog;
use Site\BaseBundle\Entity\BlogTranslation;

class BlogAdmin extends Admin
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
            ->add('created_at', 'datetime')
            ->add('updated_at', 'datetime');
    }

    protected function configureFormFields(FormMapper $form)
    {
        $subject = $form->getAdmin()->getSubject();
        $form
            ->add(
                'translations',
                'translatable_group',
                array(
                    'personal_translation' => 'Site\BaseBundle\Entity\BlogTranslation',
                    'fields'               => array('title', 'content'),
                    'widgets'              => array('title' => 'text', 'content' => 'textarea'),
                    'field_options'        => array(
                        'title'   => array('label' => 'Title'),
                        'content' => array('label' => 'Content', 'attr' => array('class' => 'tinymce', 'data-theme' => 'simple')),
                    )
                )
            );

        if ($subject->getId()) {
            $this->setTemplate('edit', 'SiteAdminBundle:BlogAdmin:edit.html.twig');
        }
    }

    public function getNewInstance()
    {
        $object = parent::getNewInstance();
        $object->setTranslatableLocale($this->getRequest()->getLocale());
        foreach (array_keys($this->languages) as $culture) {
            $object->addTranslation(new BlogTranslation($culture, 'title'));
            $object->addTranslation(new BlogTranslation($culture, 'content'));
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

    protected function updateBaseTranslation(Blog $blog)
    {
        $blog->setTranslatableLocale($this->getRequest()->getLocale());
        foreach ($blog->getTranslations() as $translation) {
            /** @var BlogTranslation $translation */
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