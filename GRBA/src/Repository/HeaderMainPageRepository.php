<?php

namespace App\Repository;

use App\Entity\HeaderMainPage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method HeaderMainPage|null find($id, $lockMode = null, $lockVersion = null)
 * @method HeaderMainPage|null findOneBy(array $criteria, array $orderBy = null)
 * @method HeaderMainPage[]    findAll()
 * @method HeaderMainPage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HeaderMainPageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, HeaderMainPage::class);
    }

    // /**
    //  * @return HeaderMainPage[] Returns an array of HeaderMainPage objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('h.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?HeaderMainPage
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
