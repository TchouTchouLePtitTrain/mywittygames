<?php

namespace Witty\ProjectBundle\Repository;

use Doctrine\ORM\EntityRepository;

class ProjectRepository extends EntityRepository
{
    public function findAllOrderedByPriority()
    {
        return $this->getEntityManager()
            ->createQuery('SELECT p FROM WittyProjectBundle:Project p WHERE p.state = :state and ( DATE_DIFF(p.endDate, CURRENT_DATE()) >= - 15 or p.endDate is null) ORDER BY p.priority DESC')
			->setParameters(array(
				'state' => 'public'
			))
            ->getResult();
    }
	
    public function findFundedOrderedByPriority()
    {
        return $this->getEntityManager()
            ->createQuery('SELECT p FROM WittyProjectBundle:Project p WHERE p.funded = 1 and p.state = :state ORDER BY p.priority DESC')
			->setParameters(array(
				'state' => 'public'
			))
            ->getResult();
    }
	
    public function findNotFundedOrderedByPriority()
    {
        return $this->getEntityManager()
            ->createQuery('SELECT p FROM WittyProjectBundle:Project p WHERE p.funded = 0 and p.state = :state and ( DATE_DIFF(p.endDate, CURRENT_DATE()) >= - 15 or p.endDate is null) ORDER BY p.priority DESC')
			->setParameters(array(
				'state' => 'public'
			))
            ->getResult();
    }	
	
    public function findComingSoonOrderedByPriority()
    {
        return $this->getEntityManager()
            ->createQuery('SELECT p FROM WittyProjectBundle:Project p WHERE p.state = :state ORDER BY p.priority DESC')
			->setParameters(array(
				'state' => 'coming_soon'
			))
            ->getResult();
    }
}