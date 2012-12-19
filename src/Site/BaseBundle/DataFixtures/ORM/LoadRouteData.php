<?php

namespace Site\BaseBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;
use Site\BaseBundle\Entity\Route;
use Site\BaseBundle\Entity\RouteTranslation as Translation;

class LoadRouteData extends AbstractFixture implements OrderedFixtureInterface
{
  /**
   * {@inheritDoc}
   */
  public function load(ObjectManager $manager)
  {
    $torres_del_paine = new Route();
    $torres_del_paine
      ->setTitle('Ruta nautica a Torres del Paine')
      ->setProgram($this->load_file('route_program_torres_del_paine_en'))
      ->setAdditional($this->load_file('route_additional_torres_del_paine_en'))
      ->setIframeCode('<iframe width="425" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"
        src="https://maps.google.com/maps/ms?msa=0&amp;msid=207804041996684053581.0004d13a53f6b3c09e4d5&amp;hl=en&amp;ie=UTF8&amp;t=h&amp;ll=-51.179447,-72.378341&amp;spn=0.528581,1.307373&amp;output=embed"></iframe>')
      ->setTranslatableLocale('en')
      ->setAccommodation($this->getReference('a-estancia-perales'))
      ->addTranslation(new Translation('en', 'title', 'Ruta nautica a Torres del Paine'))
      ->addTranslation(new Translation('en', 'program', $this->load_file('route_program_torres_del_paine_en')))
      ->addTranslation(new Translation('en', 'additional', $this->load_file('route_additional_torres_del_paine_en')))
      ->addTranslation(new Translation('es', 'title', 'Ruta nautica a Torres del Paine'))
      ->addTranslation(new Translation('es', 'program', $this->load_file('route_program_torres_del_paine_es')))
      ->addTranslation(new Translation('es', 'additional', $this->load_file('route_additional_torres_del_paine_es')));

    $manager->persist($torres_del_paine);

    for ($i = 1; $i <= 4; $i++) {
      $image = new \Site\BaseBundle\Entity\RouteImage();
      $image->setFilename("torres_del_paine$i.jpg");
      $image->setRoute($torres_del_paine);
      $manager->persist($image);
    }

    $manager->flush();
  }

  public function getOrder()
  {
    return 3;
  }

  protected function load_file($name)
  {
    return file_get_contents(__DIR__ . "/html/$name.html");
  }
}