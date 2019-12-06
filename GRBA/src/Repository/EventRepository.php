<?php

namespace App\Repository;

use App\Entity\Event;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use App\Repository\TypeRepository;
use Doctrine\ORM\Query\AST\Functions\CurrentTimestampFunction;

/**
 * @method Event|null find($id, $lockMode = null, $lockVersion = null)
 * @method Event|null findOneBy(array $criteria, array $orderBy = null)
 * @method Event[]    findAll()
 * @method Event[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EventRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Event::class);
    }

    // /**
    //  * @return Event[] Returns an array of Event objects
    //  */

    public function findNextEventsMP()
    {
        return $this->createQueryBuilder('e')
                    ->leftJoin('e.type', 't')
                    ->where("t.code=1 OR t.code=2 OR t.code=3 OR t.code=4")             
                    ->andWhere("e.date > CURRENT_TIMESTAMP()")
                    ->orderBy('e.date', 'ASC')
                    ->setMaxResults(4)
                    ->getQuery()
                    ->getResult();
    }

    public function findPastEventsMP()
    {
        return $this->createQueryBuilder('e')
                    ->leftJoin('e.type', 't')
                    ->andWhere("e.date < CURRENT_TIMESTAMP()")
                    ->orderBy('e.date', 'DESC')
                    ->setMaxResults(4)
                    ->getQuery()
                    ->getResult();
    }

    public function findOtherEventsMP()
    {
        return $this->createQueryBuilder('e')
                    ->leftJoin('e.type', 't')
                    ->where("t.code=5 OR t.code=6") 
                    ->andWhere("e.date > CURRENT_TIMESTAMP()")                   
                    ->orderBy('e.date', 'ASC')
                    ->setMaxResults(6)
                    ->getQuery()
                    ->getResult();
    }

    public function findNextEvents()
    {
        return $this->createQueryBuilder('e')
                    ->leftJoin('e.type', 't')
                    ->where("t.code=1 OR t.code=2 OR t.code=3 OR t.code=4")             
                    ->andWhere("e.date > CURRENT_TIMESTAMP()")
                    ->orderBy('e.date', 'ASC')
                    ->getQuery()
                    ->getResult();
    }

    public function findPastEvents()
    {
        return $this->createQueryBuilder('e')
                    ->leftJoin('e.type', 't')   
                    ->andWhere("e.date < CURRENT_TIMESTAMP()")
                    ->orderBy('e.date', 'DESC')
                    ->getQuery()
                    ->getResult();
    }

    // public function findOtherEvents()
    // {
    //     return $this->createQueryBuilder('e')
    //                 ->leftJoin('e.type', 't')
    //                 ->where("t.code=5 OR t.code=6") 
    //                 ->andWhere("e.date > CURRENT_TIMESTAMP()")                   
    //                 ->orderBy('e.date', 'ASC')
    //                 ->getQuery()
    //                 ->getResult();
    // }

    // public function findPastEvents()
    // {
    //     return $this->createQueryBuilder('e')
    //                 ->where("e.date < CURRENT_TIMESTAMP()")
    //                 ->orderBy('e.date', 'DESC')
    //                 ->getQuery()
    //                 ->getResult()
    // ;}

    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Event
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
