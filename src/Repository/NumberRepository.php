<?php

namespace App\Repository;

use App\Entity\TelNumber;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TelNumber|null find($id, $lockMode = null, $lockVersion = null)
 * @method TelNumber|null findOneBy(array $criteria, array $orderBy = null)
 * @method TelNumber[]    findAll()
 * @method TelNumber[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NumberRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TelNumber::class);
    }

    // /**
    //  * @return Number[] Returns an array of Number objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('n.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Number
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
