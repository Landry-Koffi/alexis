<?php

namespace App\Repository;

use App\Entity\CategoryCv;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CategoryCv|null find($id, $lockMode = null, $lockVersion = null)
 * @method CategoryCv|null findOneBy(array $criteria, array $orderBy = null)
 * @method CategoryCv[]    findAll()
 * @method CategoryCv[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategoryCvRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CategoryCv::class);
    }

    // /**
    //  * @return CategoryCv[] Returns an array of CategoryCv objects
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
    public function findOneBySomeField($value): ?CategoryCv
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
