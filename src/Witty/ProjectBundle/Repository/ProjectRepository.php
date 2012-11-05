<?php

namespace Witty\ProjectBundle\Repository;

use Doctrine\ORM\EntityRepository;

class ProjectRepository extends EntityRepository
{
    public function findAllOrderedByPriority()
    {
        return $this->getEntityManager()
            ->createQuery('SELECT p FROM WittyProjectBundle:Project p ORDER BY p.priority DESC')
            ->getResult();
    }
	
    public function findFundedOrderedByPriority()
    {
        return $this->getEntityManager()
            ->createQuery('SELECT p FROM WittyProjectBundle:Project p WHERE p.funded = 1 ORDER BY p.priority DESC')
            ->getResult();
    }
	
    public function findNotFundedOrderedByPriority()
    {
        return $this->getEntityManager()
            ->createQuery('SELECT p FROM WittyProjectBundle:Project p WHERE p.funded = 0 ORDER BY p.priority DESC')
            ->getResult();
    }
}