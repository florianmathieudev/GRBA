<?php

namespace App\Repository;

use App\Entity\Approach;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Approach|null find($id, $lockMode = null, $lockVersion = null)
 * @method Approach|null findOneBy(array $criteria, array $orderBy = null)
 * @method Approach[]    findAll()
 * @method Approach[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ApproachRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Approach::class);
    }

    // /**
    //  * @return Approach[] Returns an array of Approach objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Approach
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
