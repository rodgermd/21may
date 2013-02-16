<?php

namespace Site\BaseBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Site\BaseBundle\Entity\Blog;
use Site\BaseBundle\Entity\BlogRepository;

/**
 * @Route("/{_locale}/b", defaults={"_locale" : "en"}, requirements={"_locale"="en|es"})
 */
class BlogController extends Controller
{
  /**
   * @Route("/", name="blogs.index")
   * @Template()
   * @return array
   */
  public function indexAction()
  {
    /** @var BlogRepository $blogs_repository  */
    $blogs_repository = $this->getDoctrine()->getRepository('SiteBaseBundle:Blog');
    $blogs = $blogs_repository->getSorted();

    return compact('blogs');
  }

  /**
   * @Route("/{slug}", name="blogs.show")
   * @Template()
   * @param \Site\BaseBundle\Entity\Blog $blog
   * @return array
   */
  public function showAction(Blog $blog)
  {
    return compact('blog');
  }
}