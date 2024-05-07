<?php

namespace App\Dto;

class RequestDto extends BasicDto
{
    public function __construct(
        public readonly ?int    $id = null,
        public readonly ?int    $page = null,
        public readonly ?int    $limit = null,
        public readonly ?string $query = null,
        public readonly ?array  $author = [],
        public readonly ?array  $category = [],
    )
    {
    }
}
