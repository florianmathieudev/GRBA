<?php

namespace App\Repository;

use App\Entity\MainHeader;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method MainHeader|null find($id, $lockMode = null, $lockVersion = null)
 * @method MainHeader|null findOneBy(array $criteria, array $orderBy = null)
 * @method MainHeader[]    findAll()
 * @method MainHeader[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MainHeaderRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MainHeader::class);
    }

    // /**
    //  * @return MainHeader[] Returns an array of MainHeader objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?MainHeader
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
