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
    $selected_accommodations = $this->getDoctrine()->getRepository('SiteBaseBundle:Accommodation')->getHomepageSelected();
    return compact('selected_accommodations');
  }

  /**
   * @Route("/page/about-us", name="pages.about_us")
   * @Template()
   */
  public function aboutUsAction()
  {
    $images = $this->getDoctrine()->getRepository('SiteBaseBundle:AboutUsImage')->findAll();
    return compact('images');
  }

  /**
   * @Route("/page/history", name="pages.history")
   */
  public function historyAction()
  {

  }

  /**
   * @Route("/page/contacts", name="pages.contacts")
   */
  public function contactsAction()
  {

  }
}
