<?php

namespace App\Repository;

use App\Entity\CategoryFormation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CategoryFormation|null find($id, $lockMode = null, $lockVersion = null)
 * @method CategoryFormation|null findOneBy(array $criteria, array $orderBy = null)
 * @method CategoryFormation[]    findAll()
 * @method CategoryFormation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategoryFormationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CategoryFormation::class);
    }

    // /**
    //  * @return CategoryFormation[] Returns an array of CategoryFormation objects
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
    public function findOneBySomeField($value): ?CategoryFormation
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
