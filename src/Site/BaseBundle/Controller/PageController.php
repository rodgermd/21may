<?php

namespace Site\BaseBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * @Route("/{_locale}", defaults={"_locale" : "en"})
 */
class PageController extends Controller
{
  /**
   * @Route("/", name="index")
   * @Template()
   */
  public function indexAction()
  {
    return array();
  }
}
