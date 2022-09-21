<?php

namespace App\Repository;

use App\Entity\Monedas;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Monedas|null find($id, $lockMode = null, $lockVersion = null)
 * @method Monedas|null findOneBy(array $criteria, array $orderBy = null)
 * @method Monedas[]    findAll()
 * @method Monedas[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MonedasRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Monedas::class);
    }

    // /**
    //  * @return Monedas[] Returns an array of Monedas objects
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
    public function findOneBySomeField($value): ?Monedas
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
