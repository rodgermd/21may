<?php

namespace Site\BaseBundle\Listener;

use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Gedmo\Translatable\TranslatableListener;

class DoctrineExtensionListener implements ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    protected $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function onLateKernelRequest(GetResponseEvent $event)
    {
        /** @var TranslatableListener $translatable */
        $translatable = $this->container->get('stof_doctrine_extensions.listener.translatable');
        $translatable->setTranslatableLocale($event->getRequest()->getLocale());
    }
}