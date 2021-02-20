<?php

namespace App\Repository;

use App\Entity\Memoire;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Memoire|null find($id, $lockMode = null, $lockVersion = null)
 * @method Memoire|null findOneBy(array $criteria, array $orderBy = null)
 * @method Memoire[]    findAll()
 * @method Memoire[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MemoireRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Memoire::class);
    }

    /**
    * @return Memoire[] Returns an array of Memoire objects
    */
    public function findLatest() {
        return $this->createQueryBuilder('m')
                    ->orderBy('m.createdAt', 'desc')
                    ->setMaxResults(5)
                    ->getQuery()
                    ->getResult()
        ;
    }


    // /**
    //  * @return Memoire[] Returns an array of Memoire objects
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
    public function findOneBySomeField($value): ?Memoire
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
