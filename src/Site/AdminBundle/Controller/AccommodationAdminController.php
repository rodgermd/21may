<?php

namespace Site\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
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

      // [{"url":"http://jquery-fi,"thumbnail_url":"ht3SE=s80","name":"Pantano_de_Oreljpg","type":"image/jpeg","size":194466,"delete_url":"http://jquery-file-upload.appspot.com/AMIfv95kIUVPXkpyWe1jn25ELv6S7LzpdsP07a2Lw4ZrVfujcLj_YqdIQHhlnb_DHXVqo0Xd0wlkHBDBPv3lZ1kzVnyb0DtYteoz4bd89I8exTg2kChzZ7kEF0QwNpJ2qoC1ZgWI3jbCOS60gjAhtBpjt9bmk0p1np02BvT9tF-VLsf3lRcsFKA/Pantano_de_Orellana_by_mgarciaiz.jpg?delete=true","delete_type":"DELETE"}]


      $result = array(
        'url'  => $this->get('vich_uploader.templating.helper.uploader_helper')->asset($image, 'file'),
        'name' => $file->getClientOriginalName(),
        'type' => $file->getMimeType(),
        'size' => $file->getSize()
      );
      $result['thumbnail_url'] = $this->get('liip_imagine.templating.helper')->filter($result['url'], 'admin_image_small');

      return new Response(json_encode(array($result)));
    }
    return new Response('error', 500);
  }

  /**
   * @Method("POST")
   */
  public function orderImagesAction()
  {

  }
}