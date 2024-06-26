<?php

namespace App\Repository;

use App\Entity\CategoryBook;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CategoryBook>
 *
 * @method CategoryBook|null find($id, $lockMode = null, $lockVersion = null)
 * @method CategoryBook|null findOneBy(array $criteria, array $orderBy = null)
 * @method CategoryBook[]    findAll()
 * @method CategoryBook[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategoryBookRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CategoryBook::class);
    }

//    /**
//     * @return CategoryBook[] Returns an array of CategoryBook objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?CategoryBook
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
