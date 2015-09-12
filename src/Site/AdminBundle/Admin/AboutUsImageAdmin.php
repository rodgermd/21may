<?php
namespace Site\AdminBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Site\BaseBundle\Entity\Accommodation;
use Site\BaseBundle\Entity\AccommodationTranslation;

class AboutUsImageAdmin extends Admin
{
    protected function configureListFields(ListMapper $list) // optional
    {
        $list
            ->addIdentifier('title')
            ->addIdentifier(
                'filename',
                null,
                array(
                    'template' => 'SiteAdminBundle:AboutUsImageAdmin:list_image.html.twig',
                    'label'    => 'Image'
                )
            )
            ->add('created_at', 'date');
    }

    protected function configureFormFields(FormMapper $form)
    {
        $form
            ->add('title')
            ->add(
                'file',
                'image_delete',
                array(
                    'filter'   => 'galleries_admin_preview',
                    'required' => false,
                )
            );
    }
}