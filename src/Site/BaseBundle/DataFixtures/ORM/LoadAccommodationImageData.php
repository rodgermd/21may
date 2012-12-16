<?php

namespace Site\BaseBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;
use Site\BaseBundle\Entity\AccommodationImage;

class LoadAccommodationImageData extends AbstractFixture implements OrderedFixtureInterface
{
  public function load(ObjectManager $manager)
  {
    for ($i = 2; $i <= 5; $i++)
    {
      $o = new AccommodationImage();
      $o->setFilename("estancia_perales$i.jpg")->setAccommodation($this->getReference('a-estancia-perales'));
      $manager->persist($o);
    }

    for ($i = 2; $i <= 5; $i++)
    {
      $o = new AccommodationImage();
      $o->setFilename("monte_balmaceda$i.jpg")->setAccommodation($this->getReference('a-monte-balmaceda'));
      $manager->persist($o);
    }

    $manager->flush();
  }

  public function getOrder()
  {
    return 2;
  }
}