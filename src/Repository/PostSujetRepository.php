<?php

namespace App\Repository;

use App\Entity\PostSujet;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method PostSujet|null find($id, $lockMode = null, $lockVersion = null)
 * @method PostSujet|null findOneBy(array $criteria, array $orderBy = null)
 * @method PostSujet[]    findAll()
 * @method PostSujet[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PostSujetRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PostSujet::class);
    }

    // /**
    //  * @return PostSujet[] Returns an array of PostSujet objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PostSujet
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
