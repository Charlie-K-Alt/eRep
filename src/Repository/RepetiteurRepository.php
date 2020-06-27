<?php

namespace App\Repository;

use App\Entity\Repetiteur;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Repetiteur|null find($id, $lockMode = null, $lockVersion = null)
 * @method Repetiteur|null findOneBy(array $criteria, array $orderBy = null)
 * @method Repetiteur[]    findAll()
 * @method Repetiteur[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RepetiteurRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Repetiteur::class);
    }

    // /**
    //  * @return Repetiteur[] Returns an array of Repetiteur objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Repetiteur
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
