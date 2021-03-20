<?php

namespace App\Repository;

use App\Entity\DepositLocation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method DepositLocation|null find($id, $lockMode = null, $lockVersion = null)
 * @method DepositLocation|null findOneBy(array $criteria, array $orderBy = null)
 * @method DepositLocation[]    findAll()
 * @method DepositLocation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DepositLocationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DepositLocation::class);
    }

    // /**
    //  * @return DepositLocation[] Returns an array of DepositLocation objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?DepositLocation
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
