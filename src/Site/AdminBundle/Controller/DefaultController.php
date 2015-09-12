<?php
namespace Site\AdminBundle\Controller;

use Sonata\AdminBundle\Controller\CoreController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use Site\UserBundle\Entity\User;


/**
 * Class DefaultController
 *
 * @package Site\AdminBundle\Controller
 */
class DefaultController extends CoreController
{
    /**
     * @Route("/")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function dashboardAction()
    {
        return parent::dashboardAction();
    }
}