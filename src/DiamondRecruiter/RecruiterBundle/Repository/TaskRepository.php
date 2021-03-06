<?php

namespace DiamondRecruiter\RecruiterBundle\Repository;

/**
 * TaskRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class TaskRepository extends \Doctrine\ORM\EntityRepository
{
    public function getSearch($search)
    {
        $queryBuilder = $this->createQueryBuilder('task');
        $queryBuilder
            ->where('task.description LIKE :search1')
            ->setParameter('search1', '%'.$search.'%')
        ;
        $query = $queryBuilder->getQuery();
        return $query->getResult();
    }
}
