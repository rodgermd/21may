<?php

namespace Site\BaseBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * RouteRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class AccommodationRepository extends EntityRepository
{
  /**
   * Gets sorted accommodations
   * @return array
   */
  public function getSorted()
  {
    return $this->getSortedQb()->getQuery()->getResult();
  }

  /**
   * Gets selected to show on homepage
   * @return array
   */
  public function getHomepageSelected()
  {
    return $this->getSortedQb()->where('a.show_on_homepage = true')->getQuery()->getResult();

  }

  /**
   * Gets Qb with primary sorting
   * @return \Doctrine\ORM\QueryBuilder
   */
  public function getSortedQb()
  {
    return $this->createQueryBuilder('a')->orderBy('a.title', 'asc');
  }
}

