<?php

namespace App\Repository;

use App\Entity\EmploiLike;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method EmploiLike|null find($id, $lockMode = null, $lockVersion = null)
 * @method EmploiLike|null findOneBy(array $criteria, array $orderBy = null)
 * @method EmploiLike[]    findAll()
 * @method EmploiLike[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EmploiLikeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EmploiLike::class);
    }

    // /**
    //  * @return EmploiLike[] Returns an array of EmploiLike objects
    //  */
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
    public function findOneBySomeField($value): ?EmploiLike
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
