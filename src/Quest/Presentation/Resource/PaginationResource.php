<?php

declare(strict_types=1);

namespace App\Quest\Presentation\Resource;

use App\Shared\Application\Model\PaginationDTO;

class PaginationResource implements \JsonSerializable
{
    public function __construct(private PaginationDTO $pagination)
    {
    }

    public function jsonSerialize(): PaginationDTO
    {
        return $this->pagination;
    }
}
