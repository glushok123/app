<?php

namespace App\Repository;

use App\Dto\Order\Filter\FilterDto;
use App\Dto\RequestDto;
use App\Entity\Book;
use App\Enum\CommercialOfferStatus;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Book>
 *
 * @method Book|null find($id, $lockMode = null, $lockVersion = null)
 * @method Book|null findOneBy(array $criteria, array $orderBy = null)
 * @method Book[]    findAll()
 * @method Book[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BookRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Book::class);
    }

    public function getCollection(
        RequestDto $dto,
    ): array
    {
        $builder =  $this->createQueryBuilder('b');

        if (!empty($dto->query)){
            $builder = $builder->andWhere($builder->expr()->like('b.name', ':name'))->setParameter('name', '%' . $dto->query . '%');
            $builder = $builder->orWhere($builder->expr()->like('b.avtor', ':avtor'))->setParameter('avtor', '%' . $dto->query . '%');
        }

        if (!empty($dto->author)){
            $builder = $builder->andWhere('b.avtor IN (:avtor)')->setParameter('avtor', $dto->author);
        }

        if (!empty($dto->category)){
            $builder = $builder->andWhere('b.category IN (:category)')->setParameter('category', $dto->category);
        }

        $builder = $builder->orderBy('b.avtor', 'ASC');

        return $builder->getQuery()->getResult();
    }

    public function getCollectionAuthor(): array
    {
        $builder =  $this->createQueryBuilder('b')->select('b.avtor')->distinct();
                $builder = $builder->orderBy('b.avtor', 'ASC');

        return $builder->getQuery()->getResult();
    }
}
