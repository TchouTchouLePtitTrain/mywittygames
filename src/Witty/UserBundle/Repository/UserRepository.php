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
				INNER JOIN WittyProjectBundle:UserReward u_r WHERE u_r.rewardId = r.id
				INNER JOIN WittyUserBundle:User u WHERE u.id = u_r.userId
				WHERE r.projectId = :id 
'
			)->setParameter('id', $project_id)
            ->getResult();
    }
}