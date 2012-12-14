<?php

namespace Site\BaseBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Site\BaseBundle\Entity\Accommodation;
use Site\BaseBundle\Entity\AccommodationRepository;

/**
 * @Route("/{_locale}/a", defaults={"_locale" : "en"}, requirements={"_locale"="en|es|de"})
 */
class AccommodationController extends Controller
{

  /**
   * @Route("/", name="accommodations")
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
   * @Route("/{slug}", name="accommodation")
   * @Template
   * @param \Site\BaseBundle\Entity\Accommodation $accommodation
   * @return array
   */
  public function accommodationAction($slug)
  {
    /** @var AccommodationRepository $repository  */
    $repository = $this->getDoctrine()->getRepository('SiteBaseBundle:Accommodation');
    $accommodation = $repository->findUsingSlug($slug);
    return compact('accommodation');
  }
}