<?php
namespace AppBundle\Entity;

use Doctrine\ORM\EntityRepository;

class TaskListRepository extends EntityRepository
{
    public function findAllOrderedByName()
    {
        return $this->getEntityManager()
            ->createQuery('SELECT l FROM AppBundle:TaskList l ORDER BY l.name ASC')
            ->getResult();
    }
}
