<?php

namespace App\Repository;

use App\Entity\PostReponse;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method PostReponse|null find($id, $lockMode = null, $lockVersion = null)
 * @method PostReponse|null findOneBy(array $criteria, array $orderBy = null)
 * @method PostReponse[]    findAll()
 * @method PostReponse[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PostReponseRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PostReponse::class);
    }

    // /**
    //  * @return PostReponse[] Returns an array of PostReponse objects
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
    public function findOneBySomeField($value): ?PostReponse
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
