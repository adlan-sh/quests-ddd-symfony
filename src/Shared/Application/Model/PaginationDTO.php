<?php

declare(strict_types=1);

namespace App\Shared\Application\Model;

class PaginationDTO implements \JsonSerializable
{
    public function __construct(
        private int $page,
        private int $totalCount,
        private int $pageSize
    ) {
    }

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

    public function getPageSize(): int
    {
        return $this->pageSize;
    }

    public function setPageSize(int $pageSize): self
    {
        $this->pageSize = $pageSize;

        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
            'currentPage' => $this->getPage(),
            'totalCount' => $this->getTotalCount(),
            'pageSize' => $this->getPageSize(),
        ];
    }
}
