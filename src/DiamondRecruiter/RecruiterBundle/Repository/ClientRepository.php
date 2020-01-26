<?php

namespace DiamondRecruiter\RecruiterBundle\Repository;

/**
 * ClientRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ClientRepository extends \Doctrine\ORM\EntityRepository
{
    public function getSearch($search)
    {
        $queryBuilder = $this->createQueryBuilder('client');
        $queryBuilder
            ->where('client.name LIKE :search1')
            ->setParameter('search1', '%'.$search.'%')
        ;
        $query = $queryBuilder->getQuery();
        return $query->getResult();
    }
}
