<?php

declare(strict_types=1);

namespace App\Shared\Domain\Entity;

class Pagination
{
    private int $page;

    private int $totalCount;

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

    public function getTotalCount(): int
    {
        return $this->totalCount;
    }

    public function setTotalCount(int $totalCount): self
    {
        $this->totalCount = $totalCount;

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

    public function getPaginate(): array
    {
        return [
            'currentPage' => $this->getPage(),
            'totalCount' => $this->getTotalCount(),
            'pageSize' => $this->getLimit(),
        ];
    }
}
