<?php

namespace Site\AdminBundle\Controller;

use Sonata\AdminBundle\Controller\CRUDController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use Site\UserBundle\Entity\User;


/**
 * Class RouteImageAdminController
 *
 * @package Site\AdminBundle\Controller
 */
class RouteImageAdminController extends CRUDController
{
}