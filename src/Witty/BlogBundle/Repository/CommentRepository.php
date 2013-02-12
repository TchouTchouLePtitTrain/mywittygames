<?php

namespace Witty\BlogBundle\Repository;

use Doctrine\ORM\EntityRepository;

class CommentRepository extends EntityRepository
{
    public function findAllOrderedByCreationDate($postId)
    {
        return $this->getEntityManager()
            ->createQuery('SELECT c FROM WittyPostBundle:Comment c WHERE c.post = '.$postId.' ORDER BY c.creationDate DESC')
            ->getResult();
    }
}