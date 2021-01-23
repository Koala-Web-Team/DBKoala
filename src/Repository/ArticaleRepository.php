<?php

namespace App\Repository;

use App\Entity\Articale;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Articale|null find($id, $lockMode = null, $lockVersion = null)
 * @method Articale|null findOneBy(array $criteria, array $orderBy = null)
 * @method Articale[]    findAll()
 * @method Articale[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticaleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Articale::class);
    }


    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }



    public function findOneBySomeField($value): ?Articale
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
}
