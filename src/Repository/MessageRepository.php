<?php

namespace App\Repository;

use App\Entity\Message;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Message|null find($id, $lockMode = null, $lockVersion = null)
 * @method Message|null findOneBy(array $criteria, array $orderBy = null)
 * @method Message[]    findAll()
 * @method Message[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MessageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Message::class);
    }


    public function findUserMessages($user)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.to_id = :val')
            ->setParameter('val', $user)
            ->getQuery()
            ->getResult();
    }


    public function Message($user, $friend)
    {
        return $this->createQueryBuilder('m')
            ->Where('m.to_id = :val')
            ->andWhere('m.from_id = :val2')
            ->orderBy('m.id', 'ASC')
            ->setParameter('val', $user)
            ->setParameter('val2', $friend)
            ->getQuery()
            ->getResult();
    }


    public function countMessages($user)
    {
        return $this->createQueryBuilder('m')
            ->select('COUNT(m)')
            ->andWhere('m.to_id = :val')
            ->andWhere('m.isRead = 0')
            ->setParameter('val', $user)
            ->getQuery()
            ->getSingleScalarResult()
        ;
    }


    // /**
    //  * @return Message[] Returns an array of Message objects
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
    public function findOneBySomeField($value): ?Message
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
