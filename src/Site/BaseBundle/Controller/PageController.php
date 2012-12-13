<?php

namespace Site\BaseBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * @Route("/{_locale}", defaults={"_locale" : "en"}, requirements={"_locale"="en|es|de"})
 */
class PageController extends Controller
{
  /**
   * @Route("/", name="homepage")
   * @Template()
   */
  public function indexAction()
  {
    return array();
  }

  /**
   * @Route("/page/about-us", name="pages.about_us")
   */
  public function aboutUsAction()
  {

  }

  /**
   * @Route("/page/contacts", name="pages.contacts")
   */
  public function contactsAction()
  {

  }
}
