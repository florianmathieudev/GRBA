<?php

namespace App\Repository;

use App\Entity\Type;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Type|null find($id, $lockMode = null, $lockVersion = null)
 * @method Type|null findOneBy(array $criteria, array $orderBy = null)
 * @method Type[]    findAll()
 * @method Type[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Type::class);
    }

    public function findNextEventsByType()
    {
        return $this->createQueryBuilder('t')
                    ->leftJoin('t.events', 'e')
                    ->where("t.code=1 OR t.code=2 OR t.code=3 OR t.code=4")             
                    ->andWhere("e.date > CURRENT_TIMESTAMP()")
                    ->orderBy('e.date', 'ASC')
                    ->getQuery()
                    ->getResult();
    }

    public function findOtherEventsByType()
    {
        return $this->createQueryBuilder('t')
                    ->leftJoin('t.events', 'e')
                    ->where("t.code!=1 AND t.code!=2 AND t.code!=3 AND t.code!=4")             
                    ->andWhere("e.date > CURRENT_TIMESTAMP()")
                    ->orderBy('e.date', 'ASC')
                    ->getQuery()
                    ->getResult();
    }

    public function findPastEventsByType()
    {
        return $this->createQueryBuilder('t')
                    ->leftJoin('t.events', 'e')
                    ->andWhere("e.date > CURRENT_TIMESTAMP()")
                    ->orderBy('e.date', 'ASC')
                    ->getQuery()
                    ->getResult();
    }

    // /**
    //  * @return Type[] Returns an array of Type objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Type
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
