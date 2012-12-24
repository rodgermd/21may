<?php

namespace Site\BaseBundle\Model;
use Symfony\Component\Validator\Constraints as Assert;
use Site\BaseBundle\Entity\Route;

class RouteContactModel extends ContactModel
{

  /**
   * @var Route $route
   * @Assert\NotBlank
   */
  protected $route;

  /**
   * Gets Route
   * @return \Site\BaseBundle\Entity\Route
   */
  public function getRoute()
  {
    return $this->route;
  }

  /**
   * Sets Route
   * @param \Site\BaseBundle\Entity\Route $route
   * @return RouteContactModel
   */
  public function setRoute(Route $route)
  {
    $this->route = $route;

    return $this;
  }

}