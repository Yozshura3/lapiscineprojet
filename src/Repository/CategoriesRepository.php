<?php

namespace App\Repository;

use App\Entity\Categories;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Categories|null find($id, $lockMode = null, $lockVersion = null)
 * @method Categories|null findOneBy(array $criteria, array $orderBy = null)
 * @method Categories[]    findAll()
 * @method Categories[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategoriesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Categories::class);
    }

    /**
     * Permet de récupérer les éléments enfants d'un ID parent
     * @param int $parent
     * @return mixed
     */

    public function categoriesAndSubCategories()
    {
        $mainCategories = $this->getMainCategories();
        $categories = [];

        foreach ($mainCategories as $category) {
            $categories[] = [
                'mainCategory' => $category,
                'subCategories'=>$this->getSubCategories($category->getId())
                ];
            }
        return $categories;
    }

    // On obtient les catégories principales (On différencie car les categoryParent sont null)
    private function getMainCategories()
    {
        return $this->createQueryBuilder('c')
            ->where("c.categoryParent is NULL")
            ->setMaxResults(10)
            ->getQuery()
            ->getResult();
    }

    // On obtient les sous catégories à travers l'id de la catégorie parent
    private function getSubCategories(int $parentId)
    {
        return $this->createQueryBuilder('c')
            ->where("c.categoryParent = :categoryInput")
            ->setParameter('categoryInput', $parentId)
            ->setMaxResults(10)
            ->getQuery()
            ->getResult();
    }




// /**
    //  * @return Categories[] Returns an array of Categories objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Categories
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
