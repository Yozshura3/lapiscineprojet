<?php

namespace App\Repository;

use App\Entity\GestionAvatar;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method GestionAvatar|null find($id, $lockMode = null, $lockVersion = null)
 * @method GestionAvatar|null findOneBy(array $criteria, array $orderBy = null)
 * @method GestionAvatar[]    findAll()
 * @method GestionAvatar[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GestionAvatarRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GestionAvatar::class);
    }

    // /**
    //  * @return GestionAvatar[] Returns an array of GestionAvatar objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('g.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?GestionAvatar
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
