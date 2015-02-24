<?php
namespace AppBundle\Entity;

use Doctrine\ORM\EntityRepository;

class TaskRepository extends EntityRepository
{
    public function findAllUncompleted()
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT t, l FROM AppBundle:Task t 
                JOIN t.list l 
                WHERE t.completed = :completed 
                ORDER BY l.name ASC, t.task ASC')
            ->setParameter('completed', '0')
            ->getResult();
    }
}
