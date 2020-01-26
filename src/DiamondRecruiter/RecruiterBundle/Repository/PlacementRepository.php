<?php

namespace DiamondRecruiter\RecruiterBundle\Repository;

/**
 * PlacementRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class PlacementRepository extends \Doctrine\ORM\EntityRepository
{
    public function getSearch($search)
    {
        $queryBuilder = $this->createQueryBuilder('placement');
        $queryBuilder
            ->where('placement.title LIKE :search1')
            ->setParameter('search1', '%'.$search.'%')
        ;
        $query = $queryBuilder->getQuery();
        return $query->getResult();
    }
}
