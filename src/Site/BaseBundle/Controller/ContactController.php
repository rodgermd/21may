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
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/{_locale}", defaults={"_locale" : "en"}, requirements={"_locale"="en|es"})
 */
class ContactController extends Controller
{
    /**
     * @Route("/book/accommodation/{slug}", name="book.accommodation")
     * @Template("SiteBaseBundle:Contact:booking.html.twig")
     * @param Accommodation $accommodation
     * @param Request       $request
     *
     * @return array|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function bookAccommodationAction(Accommodation $accommodation, Request $request)
    {
        $model = new AccommodationContactModel();
        $model->setAccommodation($accommodation);
        $form = $this->createForm(new AccommodationContactType(), $model);

        if ($model = $this->process_form($form, $request)) {
            $message = new \Swift_Message(
                '21may - Booking - Accommodation - ' . $accommodation->getTitle(),
                $this->renderView('SiteBaseBundle:Contact:booking_accommodation.html.twig', compact('model', 'accommodation')),
                'text/html'
            );
            $message->setFrom($this->container->getParameter('site.email.from'));
            $message->setTo($this->container->getParameter('site.email.to'));

            if ($model->getEmail()) {
                $message->setReplyTo($model->getEmail(), $model->getName());
            }

            $this->get('mailer')->send($message);
            $this->get('session')->getFlashBag()->add('contact-success', 'Your form was sent successfully');

            return $this->redirect($this->generateUrl('book.route', array('slug' => $accommodation->getSlug())));
        }

        return array('form' => $form->createView(), 'object' => $accommodation);
    }

    /**
     * @Route("/book/route/{slug}", name="book.route")
     * @Template("SiteBaseBundle:Contact:booking.html.twig")
     * @param AccommodationRoute $route
     * @param Request            $request
     *
     * @return array|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function bookRouteAction(AccommodationRoute $route, Request $request)
    {
        $model = new RouteContactModel();
        $form  = $this->createForm(new RouteContactType(), $model);

        if ($model = $this->process_form($form, $request)) {
            $message = new \Swift_Message(
                '21may - Booking - Route - ' . $route->getTitle(),
                $this->renderView('SiteBaseBundle:Contact:booking_route.html.twig', compact('model', 'route')),
                'text/html'
            );
            $message->setFrom($this->container->getParameter('site.email.from'));
            $message->setTo($this->container->getParameter('site.email.to'));

            if ($model->getEmail()) {
                $message->setReplyTo($model->getEmail(), $model->getName());
            }

            $this->get('mailer')->send($message);
            $this->get('session')->getFlashBag()->add('contact-success', 'Your form was sent successfully');

            return $this->redirect($this->generateUrl('book.route', array('slug' => $route->getSlug())));
        }

        return array('form' => $form->createView(), 'object' => $route);
    }

    /**
     * @Route("/contact", name="contact")
     * @Template
     *
     * @param Request $request
     *
     * @return array|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function contactAction(Request $request)
    {
        $model = new ContactModel();
        $form  = $this->createForm(new ContactType(), $model);

        if ($model = $this->process_form($form, $request)) {
            /** @var ContactModel $model $message */
            $message = new \Swift_Message(
                'Contact message from 21may',
                $this->renderView('SiteBaseBundle:Contact:mail_contact.html.twig', array('model' => $model)),
                'text/html'
            );
            $message->setFrom($this->container->getParameter('site.email.from'));
            $message->setTo($this->container->getParameter('site.email.to'));

            if ($model->getEmail()) {
                $message->setReplyTo($model->getEmail(), $model->getName());
            }

            $this->get('mailer')->send($message);
            $this->get('session')->getFlashBag()->add('contact-success', 'Your form was sent successfully');

            return $this->redirect('contact');
        }

        return array('form' => $form->createView());
    }

    /**
     * Processes the form
     *
     * @param Form    $form
     * @param Request $request
     *
     * @return bool|mixed
     */
    protected function process_form(Form $form, Request $request)
    {
        if (!$request->isMethod('POST')) {
            return false;
        }
        $form->handleRequest($request);

        return ($form->isValid()) ? $form->getData() : false;
    }
}