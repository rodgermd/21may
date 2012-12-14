<?php

namespace Site\BaseBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;
use Site\BaseBundle\Entity\Accommodation;
use Site\BaseBundle\Entity\AccommodationTranslation as Translation;

class LoadAccommodationData extends AbstractFixture implements OrderedFixtureInterface
{
  /**
   * {@inheritDoc}
   */
  public function load(ObjectManager $manager)
  {
    $estancia_perales = new Accommodation();
    $estancia_perales
      ->setImageFilename('estancia_perales.jpg')
      ->setTitle('Estancia Perales')
      ->setDescription($this->load_file('estancia_perales1_en'))
      ->setSecondaryText($this->load_file('estancia_perales2_en'))
      ->setTranslatableLocale('en')
      ->addTranslation(new Translation('en', 'title', 'Estancia Perales'))
      ->addTranslation(new Translation('en', 'description', $this->load_file('estancia_perales1_en')))
      ->addTranslation(new Translation('en', 'secondary_text', $this->load_file('estancia_perales2_en')))
      ->addTranslation(new Translation('es', 'title', 'Estancia Perales'))
      ->addTranslation(new Translation('es', 'description', $this->load_file('estancia_perales1_es')))
      ->addTranslation(new Translation('es', 'secondary_text', $this->load_file('estancia_perales2_es')))
    ;

    $this->addReference('a-estancia-perales', $estancia_perales);
    $manager->persist($estancia_perales);

    $montes_balmaceda = new Accommodation();
    $montes_balmaceda
      ->setTitle('Montes Balmaceda')
      ->setImageFilename('monte_balmaceda1.jpg')
      ->setDescription($this->load_file('montes_balmaceda1_en'))
      ->setSecondaryText($this->load_file('montes_balmaceda2_en'))
      ->setTranslatableLocale('en')
      ->addTranslation(new Translation('en', 'title', 'Montes Balmaceda'))
      ->addTranslation(new Translation('en', 'description', $this->load_file('montes_balmaceda1_en')))
      ->addTranslation(new Translation('en', 'secondary_text', $this->load_file('montes_balmaceda2_en')))
      ->addTranslation(new Translation('es', 'title', 'Montes Balmaceda'))
      ->addTranslation(new Translation('es', 'description', $this->load_file('montes_balmaceda1_es')))
      ->addTranslation(new Translation('es', 'secondary_text', $this->load_file('montes_balmaceda2_es')))
    ;

    $this->addReference('a-monte-balmaceda', $montes_balmaceda);
    $manager->persist($montes_balmaceda);

    $manager->flush();
  }

  public function getOrder()
  {
    return 1;
  }

  protected function load_file($name)
  {
    return file_get_contents(__DIR__ . "/html/$name.html");
  }
}