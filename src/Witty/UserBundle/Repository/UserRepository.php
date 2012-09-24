<?php

namespace Witty\UserBundle\Repository;

use Doctrine\ORM\EntityRepository;

class UserRepository extends EntityRepository
{
    public function findEdinautesByProjectId($project_id)
    {
        return $this->getEntityManager()
            ->createQuery('
				SELECT u FROM WittyProjectBundle:Reward r
				INNER JOIN WittyProjectBundle:UserReward u_r WHERE u_r.reward = r.id
				INNER JOIN WittyUserBundle:User u WHERE u.id = u_r.user
				WHERE r.project = :id 
				AND u_r.cancelled = 0'
			)->setParameter('id', $project_id)
            ->getResult();
    }
}