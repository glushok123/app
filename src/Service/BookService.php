<?php

namespace App\Service;

use App\Dto\RequestDto;
use App\Repository\BookRepository;
use App\Repository\CategoryBookRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;

class BookService
{
    const LIMIT = 20;
    const PAGE = 1;
    private $serializer;

    public function __construct(
        private readonly EntityManagerInterface $entityManager,
        private readonly BookRepository         $repository,
        private readonly CategoryBookRepository $categoryBookRepository,
    )
    {
    }

    public function getCollection(PaginatorInterface $paginator, RequestDto $dto)
    {
        if (empty($books = $this->repository->getCollection($dto))) {
            return null;
        }

        $pagination = $paginator->paginate($books, $dto->page ?? self::PAGE, $dto->limit ?? self::LIMIT);

        return $pagination;
    }

    public function getCollectionAuthor(RequestDto $dto)
    {
        if (empty($authors = $this->repository->getCollectionAuthor())) {
            return null;
        }
        foreach ($authors as $key => $author) {
            $authors[$key]['selected'] = false;
        }

        if (!empty($dto->author)) {
            foreach ($authors as $key => $author) {
                if (in_array($author['avtor'], $dto->author)) {
                    $authors[$key]['selected'] = true;
                }
            }
        }


        return $authors;
    }

    public function getCollectionCategory(RequestDto $dto)
    {
        $categoryBooksArray = [];
        if (empty($categoryBooks = $this->categoryBookRepository->findAll())) {
            return null;
        }

        foreach ($categoryBooks as $categoryBook) {
            $categoryBooksArray[] = [
                "id" => $categoryBook->getId(),
                "name" => $categoryBook->getName(),
                "selected" => false,
            ];
        }

        if (!empty($dto->category)) {
            foreach ($categoryBooksArray as $key => $category) {
                if (in_array($category['id'], $dto->category)) {
                    $categoryBooksArray[$key]['selected'] = true;
                } else {
                    $categoryBooksArray[$key]['selected'] = false;
                }
            }
        }

        return $categoryBooksArray;
    }

    public function get(RequestDto $dto)
    {
        return $this->repository->findOneBy(['id' => $dto->id]);
    }
}