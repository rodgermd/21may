<?php

namespace Site\BaseBundle\Listener;

use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

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
    $translatable = $this->container->get('gedmo.listener.translatable');
    $translatable->setTranslatableLocale($event->getRequest()->getLocale());
  }
}