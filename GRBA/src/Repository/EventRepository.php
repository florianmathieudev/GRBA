<?php

namespace App\Repository;

use App\Entity\Event;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

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


    public function findNextLastEvents()
    {
        return $this->createQueryBuilder('e')
                    ->where("e.type=1 OR e.type=2 OR e.type=3 OR e.type=4")                    
                    ->andWhere("e.content IS NULL")
                    ->orderBy('e.id', 'DESC')
                    ->setMaxResults(3)
                    ->getQuery()
                    ->getResult();
    }


    public function findPreviousLastEvents()
    {
        return $this->createQueryBuilder('e')
                    ->Where("e.content IS NOT NULL")
                    ->orderBy('e.id', 'DESC')
                    ->setMaxResults(3)
                    ->getQuery()
                    ->getResult();
    }

    public function findOtherLastEvents()
    {
        return $this->createQueryBuilder('e')
                    ->where("e.type=5 OR e.type=6")                    
                    ->andWhere("e.content IS NULL")
                    ->orderBy('e.id', 'DESC')
                    ->setMaxResults(4)
                    ->getQuery()
                    ->getResult();
    }



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
