<?php

namespace Witty\ProjectBundle\Repository;

use Doctrine\ORM\EntityRepository;

class ProjectRepository extends EntityRepository
{
    public function findAllOrderedByPriority()
    {
        return $this->getEntityManager()
            ->createQuery('SELECT p FROM WittyProjectBundle:Project p ORDER BY p.priority ASC')
            ->getResult();
    }
}