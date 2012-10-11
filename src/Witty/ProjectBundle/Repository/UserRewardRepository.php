<?php

namespace Witty\ProjectBundle\Repository;

use Doctrine\ORM\EntityRepository;

class UserRewardRepository extends EntityRepository
{
    public function findAllByUserIdOrderedByProjectIds($userId)
    {
        return $this->getEntityManager()
            ->createQuery(
						'SELECT u FROM WittyProjectBundle:UserReward u
						INNER JOIN WittyProjectBundle:Reward r WITH r.id = u.reward
						INNER JOIN WittyProjectBundle:Project p WITH p.id = r.project
						WHERE u.cancelled = 0 AND u.user = :id
						ORDER BY p.id DESC')
			->setParameter('id', $userId)
            ->getResult();
    }
}