<?php
namespace Site\AdminBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Site\UserBundle\Entity\User;

class UserAdmin extends Admin
{
    protected function configureListFields(ListMapper $list) // optional
    {
        $list->addIdentifier('username')->add('email');
    }

    protected function configureFormFields(FormMapper $form)
    {
        $form
            ->add('username')
            ->add('email')
            ->add(
                'plain_password',
                'password',
                array(
                    'required' => !$this->getSubject()->getId(),
                    'label'    => $this->getSubject()->getId() ? 'Change password' : 'Password'
                )
            )
            ->add('locked', null, array('required' => false))
            ->add('expired', null, array('required' => false));
    }

}