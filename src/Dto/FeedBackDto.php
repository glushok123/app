<?php

namespace App\Dto;

class FeedBackDto extends BasicDto
{
    public function __construct(
        public readonly ?string             $name = null,
        public readonly ?string             $email = null,
        public readonly ?string             $phone = null,
        public readonly ?string             $message = null,
        public readonly ?string             $book = null,
    )
    {
    }
}
