<?php

namespace Site\BaseBundle\Model;
use Symfony\Component\Validator\Constraints as Assert;

class ContactModel {

  /**
   * @var string $name
   * @Assert\NotBlank
   */
  protected $name;

  /**
   * @var string $phone
   */
  protected $phone;

  /**
   * @var string $email
   * @Assert\Email
   * @Assert\NotBlank
   */
  protected $email;

  /**
   * @var string $nationality
   */
  protected $nationality;

  /**
   * @var string $message
   * @Assert\NotBlank
   * @Assert\Length(min=10, minMessage="Enter 10 symbols or more|Enter 10 symbols or more")
   */
  protected $message;

  /**
   * Gets name
   * @return string
   */
  public function getName()
  {
    return $this->name;
  }

  /**
   * Sets name
   * @param $name
   * @return ContactModel
   */
  public function setName($name)
  {
    $this->name = $name;

    return $this;
  }

  /**
   * Gets phone
   * @return string
   */
  public function getPhone()
  {
    return $this->phone;
  }

  /**
   * Sets phone
   * @param $phone
   * @return ContactModel
   */
  public function setPhone($phone)
  {
    $this->phone = $phone;

    return $this;
  }

  /**
   * Gets email
   * @return string
   */
  public function getEmail()
  {
    return $this->email;
  }

  /**
   * Sets email
   * @param $email
   * @return ContactModel
   */
  public function setEmail($email)
  {
    $this->email = $email;

    return $this;
  }

  /**
   * Gets nationality
   * @return string
   */
  public function getNationality()
  {
    return $this->nationality;
  }

  /**
   * Sets nationality
   * @param $nationality
   * @return ContactModel
   */
  public function setNationality($nationality)
  {
    $this->nationality = $nationality;

    return $this;
  }

  /**
   * Gets message
   * @return string
   */
  public function getMessage()
  {
    return $this->message;
  }

  /**
   * Sets message
   * @param $message
   * @return ContactModel
   */
  public function setMessage($message)
  {
    $this->message = $message;

    return $this;
  }
}