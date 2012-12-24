<?php

namespace Site\BaseBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Site\BaseBundle\Entity\Route as AccommodationRoute;
use Site\BaseBundle\Entity\Accommodation;
use Site\BaseBundle\Entity\AccommodationRepository;

use Site\BaseBundle\Model\ContactModel;
use Site\BaseBundle\Form\ContactType;
use Symfony\Component\Form\Form;
use Site\BaseBundle\Model\AccommodationContactModel;
use Site\BaseBundle\Form\AccommodationContactType;
use Site\BaseBundle\Model\RouteContactModel;
use Site\BaseBundle\Form\RouteContactType;

/**
 * @Route("/{_locale}", defaults={"_locale" : "en"}, requirements={"_locale"="en|es"})
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

  /**
   * @Route("/contact", name="contact")
   * @Template
   */
  public function contactAction()
  {
    $model = new ContactModel();
    $form = $this->createForm(new ContactType(), $model);

    if ($model = $this->process_form($form))
    {
      $this->get('session')->getFlashBag()->add('notice', 'Your form was sent successfully');
      return $this->redirect('contact');
    }
    return array('form' => $form->createView());
  }

  protected function process_form(Form $form)
  {
    if (!$this->getRequest()->isMethod('POST')) return false;
    $form->bind($this->getRequest());
    return ($form->isValid()) ? $form->getData() : false;
  }
}