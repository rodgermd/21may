<?php

namespace Site\BaseBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Routing\Router;
use Symfony\Component\HttpFoundation\Request;

class LanguageController extends Controller
{
  /**
   * @Route("/", requirements={"_locale"="en|es|de"})
   */
  public function indexAction()
  {
    $locale = $this->getRequest()->getLocale();
    return $this->redirect($this->generateUrl('homepage', array('_locale' => $locale)));
  }

  /**
   * @Route("/switch-to")
   * @Template
   */
  public function switchAction($route, $route_params, $current)
  {
    $languages = $this->container->getParameter('languages');
    unset($languages[$current]);
    $available_locales = array_keys($languages);
    $target_locale = $available_locales[0];
    $route_params['_locale'] = $target_locale;

    return compact('route', 'route_params', 'target_locale');
  }
}