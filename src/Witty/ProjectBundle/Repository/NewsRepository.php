<?php

namespace Witty\ProjectBundle\Repository;

use Doctrine\ORM\EntityRepository;

class NewsRepository extends EntityRepository
{
    public function findAllOrderedByCreationDate($projectId)
    {
        return $this->getEntityManager()
            ->createQuery('SELECT n FROM WittyProjectBundle:News n WHERE n.project = '.$projectId.' ORDER BY n.creationDate DESC')
            ->getResult();
    }
}