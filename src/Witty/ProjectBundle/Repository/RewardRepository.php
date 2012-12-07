<?php

namespace Witty\ProjectBundle\Repository;

use Doctrine\ORM\EntityRepository;

class RewardRepository extends EntityRepository
{
    public function findAllOrderedByCost($projectId)
    {
        return $this->getEntityManager()
            ->createQuery('SELECT r FROM WittyProjectBundle:Reward r WHERE r.project = '.$projectId.' ORDER BY r.cost asc')
            ->getResult();
    }
}