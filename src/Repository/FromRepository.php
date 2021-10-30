<?php

namespace App\Repository;

use App\Entity\From;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method From|null find($id, $lockMode = null, $lockVersion = null)
 * @method From|null findOneBy(array $criteria, array $orderBy = null)
 * @method From[]    findAll()
 * @method From[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FromRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, From::class);
    }

    // /**
    //  * @return From[] Returns an array of From objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?From
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
