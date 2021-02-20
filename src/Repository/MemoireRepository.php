<?php

namespace App\Repository;

use App\Data\SearchData;
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

    /**
     * Récupere les memoires liés à une recherche
     * @return Memoire[]
     */
    public function findSearch(SearchData $search)
    {
        $query = $this
                ->createQueryBuilder('m')
                ->select('c', 'm')
                ->join('m.categories', 'c')
        ;

        if (!empty($search->q)) {
            $query = $query
                        ->andWhere('m.title LIKE :q')
                        ->setParameter('q', "%{$search->q}%")
            ;
        }

        if (!empty($search->categories)) {
            $query = $query
                        ->andWhere('c.id IN (:categories)')
                        ->setParameter('categories', $search->categories)
            ;
        }

        return $query->getQuery()->getResult();
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
