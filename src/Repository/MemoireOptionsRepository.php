<?php

namespace App\Repository;

use App\Entity\MemoireOptions;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method MemoireOptions|null find($id, $lockMode = null, $lockVersion = null)
 * @method MemoireOptions|null findOneBy(array $criteria, array $orderBy = null)
 * @method MemoireOptions[]    findAll()
 * @method MemoireOptions[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MemoireOptionsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MemoireOptions::class);
    }

    // /**
    //  * @return MemoireOptions[] Returns an array of MemoireOptions objects
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
    public function findOneBySomeField($value): ?MemoireOptions
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
