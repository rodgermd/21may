<?php

namespace Site\AdminBundle\Controller;

use Sonata\AdminBundle\Controller\CRUDController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Response;

use Site\BaseBundle\Entity\Route;
use Site\BaseBundle\Entity\RouteImage;
use Site\AdminBundle\Form\RouteImageType;

/**
 * Class RouteAdminController
 *
 * @package Site\AdminBundle\Controller
 */
class RouteAdminController extends CRUDController
{
    /**
     * @Method("POST")
     * @param Route   $route
     * @param Request $request
     *
     * @return Response
     */
    public function uploadImagesAction(Route $route, Request $request)
    {
        $image = new RouteImage();
        $image->setRoute($route);

        $form = $this->createForm(new RouteImageType(), $image);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $file = $image->getFile();
            $em   = $this->getDoctrine()->getManager();
            $em->persist($image);
            $em->flush();


            $result                 = array(
                'url'        => $this->get('vich_uploader.templating.helper.uploader_helper')->asset($image, 'file'),
                'name'       => $file->getClientOriginalName(),
                'type'       => $file->getMimeType(),
                'size'       => $file->getSize(),
                'deleteUrl'  => $this->generateUrl('admin_site_base_routeimage_delete', array('id' => $image->getId())),
                'deleteType' => 'DELETE'
            );
            $result['thumbnailUrl'] = $this->get('liip_imagine.templating.helper')->filter($result['url'], 'route_image_small');

            return new Response(json_encode(array('files' => array($result))));
        }

        return new Response('error', 500);
    }

    /**
     * @Method("POST")
     */
    public function orderImagesAction(Route $route)
    {
        $order  = $this->getRequest()->get('images', array());
        $images = $route->getImages();
        $em     = $this->getDoctrine()->getManager();

        $i = 1;
        foreach ($order as $id) {
            foreach ($images as $image) {
                /** @var AccommodationImage $image */
                if ($image->getId() == $id) {
                    $image->setStackOrder($i++) && $em->persist($image);
                }
            }
        }

        $em->flush();

        return new Response('ok');
    }
}