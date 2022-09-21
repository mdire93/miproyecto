<?php

namespace App\Repository;

use App\Entity\Usuariossectores;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Usuariossectores|null find($id, $lockMode = null, $lockVersion = null)
 * @method Usuariossectores|null findOneBy(array $criteria, array $orderBy = null)
 * @method Usuariossectores[]    findAll()
 * @method Usuariossectores[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UsuariossectoresRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Usuariossectores::class);
    }

    // /**
    //  * @return Usuariossectores[] Returns an array of Usuariossectores objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Usuariossectores
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
