<?php

declare(strict_types=1);

namespace App\Review\Application\Request;

use Symfony\Component\Validator\Constraints as Assert;

class GetUserReviewsRequest
{
    #[Assert\Type('integer')]
    private int $page = 1;

    #[Assert\Type('integer')]
    private int $limit = 12;

    public function getPage(): int
    {
        return $this->page;
    }

    public function setPage(int $page): self
    {
        $this->page = $page;

        return $this;
    }

    public function getLimit(): int
    {
        return $this->limit;
    }

    public function setLimit(int $limit): self
    {
        $this->limit = $limit;

        return $this;
    }
}
