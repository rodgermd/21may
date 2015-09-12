<?php
namespace Site\AdminBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Site\BaseBundle\Entity\Accommodation;
use Site\BaseBundle\Entity\AccommodationTranslation;

class BlogImageAdmin extends Admin
{

    protected function configureListFields(ListMapper $list) // optional
    {
        $list
            ->addIdentifier(
                'filename',
                null,
                array(
                    'template' => 'SiteAdminBundle:BlogImageAdmin:list_image.html.twig',
                    'label'    => 'Image'
                )
            )
            ->add('blog');

        $this->getRequest()->enableHttpMethodParameterOverride();
    }

    protected function configureFormFields(FormMapper $form)
    {
        $form
            ->add('blog')
            ->add(
                'file',
                'image_delete',
                array(
                    'filter'   => 'blog_admin_preview',
                    'required' => false,
                    'label'    => ' '
                )
            );
    }
}