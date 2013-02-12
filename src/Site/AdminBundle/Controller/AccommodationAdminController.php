<?php

namespace Site\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Response;

use Site\BaseBundle\Entity\Accommodation;
use Site\BaseBundle\Entity\AccommodationImage;
use Site\AdminBundle\Form\AccommodationImageType;

class AccommodationAdminController extends \Sonata\AdminBundle\Controller\CRUDController
{
  /**
   * @Method("POST")
   */
  public function uploadImagesAction(Accommodation $accommodation)
  {
    $image = new AccommodationImage();
    $image->setAccommodation($accommodation);

    $form = $this->createForm(new AccommodationImageType(), $image);
    $form->bind($this->getRequest());

    if ($form->isValid())
    {
      $file = $image->getFile();
      $em = $this->getDoctrine()->getManager();
      $em->persist($image);
      $em->flush();


      $result = array(
        'url'  => $this->get('vich_uploader.templating.helper.uploader_helper')->asset($image, 'file'),
        'name' => $file->getClientOriginalName(),
        'type' => $file->getMimeType(),
        'size' => $file->getSize(),
        'delete_url' => $this->generateUrl('admin_site_base_accommodationimage_delete', array('id' => $image->getId())),
        'delete_type' => 'DELETE'
      );
      $result['thumbnail_url'] = $this->get('liip_imagine.templating.helper')->filter($result['url'], 'admin_accommodation_small');

      return new Response(json_encode(array($result)));
    }
    return new Response('error', 500);
  }

  /**
   * @Method("POST")
   */
  public function orderImagesAction(Accommodation $accommodation)
  {
    $order = $this->getRequest()->get('images', array());
    $images = $accommodation->getImages();
    $em = $this->getDoctrine()->getManager();

    $i = 1;
    foreach($order as $id)
    {
      foreach($images as $image)
      {
        /** @var AccommodationImage $image */
        if ($image->getId() ==  $id) $image->setStackOrder($i++) && $em->persist($image);
      }
    }

    $em->flush();

    return new Response('ok');
  }
}