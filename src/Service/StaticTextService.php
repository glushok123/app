<?php

namespace App\Service;

use App\Dto\RequestDto;
use App\Repository\BookRepository;
use App\Repository\CategoryBookRepository;
use App\Repository\StaticTextRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;

class StaticTextService
{
    private $serializer;

    const LIMIT = 20;
    const PAGE = 1;

    public function __construct(
        private readonly StaticTextRepository         $repository,
    )
    {
    }

    public function get(string $name)
    {
        $staticText = $this->repository->findOneBy(['name' => $name]);

        return $staticText->getDescription();
    }
}
