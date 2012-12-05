<?php

namespace Site\BaseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Route
 *
 * @ORM\Table(name="routes")
 * @ORM\Entity(repositoryClass="Site\BaseBundle\Entity\RouteRepository")
 */
class Route
{
  /**
   * @var integer
   *
   * @ORM\Column(name="id", type="integer")
   * @ORM\Id
   * @ORM\GeneratedValue(strategy="AUTO")
   */
  private $id;

  /**
   * @var string
   *
   * @ORM\Column(name="title", type="string", length=255)
   */
  private $title;

  /**
   * @var string
   *
   * @ORM\Column(name="program", type="text")
   */
  private $program;

  /**
   * @var string
   *
   * @ORM\Column(name="iframe_code", type="text")
   */
  private $iframe_code;

  /**
   * @var \DateTime
   *
   * @ORM\Column(name="created_at", type="datetime")
   */
  private $created_at;

  /**
   * @var \DateTime
   *
   * @ORM\Column(name="updated_at", type="datetime")
   */
  private $updated_at;


  /**
   * Get id
   *
   * @return integer
   */
  public function getId()
  {
    return $this->id;
  }

  /**
   * Set title
   *
   * @param string $title
   * @return Route
   */
  public function setTitle($title)
  {
    $this->title = $title;

    return $this;
  }

  /**
   * Get title
   *
   * @return string
   */
  public function getTitle()
  {
    return $this->title;
  }

  /**
   * Set program
   *
   * @param string $program
   * @return Route
   */
  public function setProgram($program)
  {
    $this->program = $program;

    return $this;
  }

  /**
   * Get program
   *
   * @return string
   */
  public function getProgram()
  {
    return $this->program;
  }

  /**
   * Set iframe_code
   *
   * @param string $iframeCode
   * @return Route
   */
  public function setIframeCode($iframeCode)
  {
    $this->iframe_code = $iframeCode;

    return $this;
  }

  /**
   * Get iframe_code
   *
   * @return string
   */
  public function getIframeCode()
  {
    return $this->iframe_code;
  }

  /**
   * Set created_at
   *
   * @param \DateTime $createdAt
   * @return Route
   */
  public function setCreatedAt($createdAt)
  {
    $this->created_at = $createdAt;

    return $this;
  }

  /**
   * Get created_at
   *
   * @return \DateTime
   */
  public function getCreatedAt()
  {
    return $this->created_at;
  }

  /**
   * Set updated_at
   *
   * @param \DateTime $updatedAt
   * @return Route
   */
  public function setUpdatedAt($updatedAt)
  {
    $this->updated_at = $updatedAt;

    return $this;
  }

  /**
   * Get updated_at
   *
   * @return \DateTime
   */
  public function getUpdatedAt()
  {
    return $this->updated_at;
  }
}
