<?php

namespace App\Repository;

use App\Entity\MobileFrom;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method MobileFrom|null find($id, $lockMode = null, $lockVersion = null)
 * @method MobileFrom|null findOneBy(array $criteria, array $orderBy = null)
 * @method MobileFrom[]    findAll()
 * @method MobileFrom[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MobileFromRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MobileFrom::class);
    }

    // /**
    //  * @return MobileFrom[] Returns an array of MobileFrom objects
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
    public function findOneBySomeField($value): ?MobileFrom
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
