<?php

namespace Site\BaseBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Site\BaseBundle\Entity\Accommodation;
use Site\BaseBundle\Entity\AccommodationTranslation as Translation;

class LoadAccommodationData implements FixtureInterface
{
  /**
   * {@inheritDoc}
   */
  public function load(ObjectManager $manager)
  {
    $accommodation1 = new Accommodation();
    $accommodation1
      ->setTitle('title en')
      ->setDescription('description en')
      ->setSecondaryText('secondary_text en')
      ->setTranslatableLocale('en')
      ->addTranslation(new Translation('en', 'title', 'title en'))
      ->addTranslation(new Translation('en', 'description', 'description en'))
      ->addTranslation(new Translation('en', 'secondary_text', 'secondary_text en'))
      ->addTranslation(new Translation('es', 'title', 'title es'))
      ->addTranslation(new Translation('es', 'description', 'description es'))
      ->addTranslation(new Translation('es', 'secondary_text', 'secondary_text es'))
    ;

    $manager->persist($accommodation1);
    $manager->flush();
  }
}