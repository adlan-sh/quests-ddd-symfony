<?php

declare(strict_types=1);

namespace App\Quest\Application\Request;

use Symfony\Component\Validator\Constraints as Assert;

class GetListQuestsRequest
{
    #[Assert\Type('integer')]
    private int $page = 1;

    #[Assert\Type('integer')]
    private int $limit = 12;

    #[Assert\Type('string')]
    private string $sort = 'ASC';

    #[Assert\Type('array')]
    private array $filterKey = [];

    #[Assert\Type('array')]
    private array $filterValue = [];

    private ?string $search = null;

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

    public function getSort(): string
    {
        return $this->sort;
    }

    public function setSort(string $sort): self
    {
        $this->sort = $sort;

        return $this;
    }

    public function getFilterKey(): array
    {
        return $this->filterKey;
    }

    public function setFilterKey(array $filterKey): self
    {
        $this->filterKey = $filterKey;

        return $this;
    }

    public function getFilterValue(): array
    {
        return $this->filterValue;
    }

    public function setFilterValue(array $filterValue): self
    {
        $this->filterValue = $filterValue;

        return $this;
    }

    public function getSearch(): ?string
    {
        return $this->search;
    }

    public function setSearch(?string $search): self
    {
        $this->search = $search;

        return $this;
    }
}
