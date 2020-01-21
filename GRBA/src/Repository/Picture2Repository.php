<?php

namespace App\Repository;

use App\Entity\Picture2;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Picture2|null find($id, $lockMode = null, $lockVersion = null)
 * @method Picture2|null findOneBy(array $criteria, array $orderBy = null)
 * @method Picture2[]    findAll()
 * @method Picture2[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class Picture2Repository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Picture2::class);
    }

    // /**
    //  * @return Picture2[] Returns an array of Picture2 objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Picture2
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
