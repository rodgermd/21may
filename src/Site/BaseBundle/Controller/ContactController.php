<?php

namespace Site\BaseBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Site\BaseBundle\Entity\Route as AccommodationRoute;
use Site\BaseBundle\Entity\Accommodation;
use Site\BaseBundle\Entity\AccommodationRepository;

/**
 * @Route("/{_locale}/contact", defaults={"_locale" : "en"}, requirements={"_locale"="en|es|de"})
 */
class ContactController extends Controller
{
  /**
   * @Route("/book/accommodation/{slug}", name="book.accommodation")
   * @Template
   */
  public function bookAccommodationAction(Accommodation $accommodation)
  {
    return compact('accommodation');
  }

  /**
   * @Route("/book/route/{slug}", name="book.route")
   * @Template
   */
  public function bookRouteAction(AccommodationRoute $route)
  {
    return compact('route');
  }
}