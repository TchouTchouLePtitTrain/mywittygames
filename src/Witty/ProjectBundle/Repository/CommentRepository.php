<?php

namespace Witty\ProjectBundle\Repository;

use Doctrine\ORM\EntityRepository;

class CommentRepository extends EntityRepository
{
    public function findAllOrderedByCreationDate($projectId)
    {
        return $this->getEntityManager()
            ->createQuery('SELECT c FROM WittyProjectBundle:Comment c WHERE c.project = '.$projectId.' ORDER BY c.creationDate DESC')
            ->getResult();
    }
}