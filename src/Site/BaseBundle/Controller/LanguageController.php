<?php

namespace Site\BaseBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

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
}