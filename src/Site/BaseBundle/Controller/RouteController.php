<?php

namespace Site\BaseBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Site\BaseBundle\Entity\Accommodation;
use Site\BaseBundle\Entity\Route as AccommodationRoute;
use Site\BaseBundle\Entity\AccommodationRepository;

/**
 * @Route("/{_locale}/r", defaults={"_locale" : "en"}, requirements={"_locale"="en|es"})
 */
class RouteController extends Controller
{

  /**
   * @Route("/", name="routes")
   * @Template
   */
  public function indexAction()
  {
    $accommodations = $this->getDoctrine()->getRepository("SiteBaseBundle:Accommodation")->getSorted();
    return compact('accommodations');
  }

  /**
   * @Template
   */
  public function menu_listAction()
  {
    return $this->indexAction();
  }

  /**
   * @Route("/{slug}", name="route")
   * @Template
   */
  public function routeAction(AccommodationRoute $route)
  {
    return compact('route');
  }
}