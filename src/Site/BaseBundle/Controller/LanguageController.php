<?php

namespace Site\BaseBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class LanguageController extends Controller
{
  /**
   * @Route("/")
   */
  public function indexAction()
  {
    $locale = $this->getRequest()->getLocale();
    return $this->redirect($this->generateUrl('index', array('_locale' => $locale)));
  }
}