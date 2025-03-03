<?php

declare(strict_types=1);

namespace App\Quest\Application\UseCase\GetListQuests;

use App\Shared\Application\Model\PaginationDTO;
use App\Shared\Application\UseCase\CommandResultInterface;

readonly class GetListQuestsCommandResult implements CommandResultInterface
{
    public function __construct(
        private PaginationDTO $pagination,
        private array $questList,
        private int $code
    ) {
    }

    public function getResult(): array
    {
        return [
            'pagination' => $this->pagination,
            'list' => $this->questList,
        ];
    }

    public function getCode(): int
    {
        return $this->code;
    }
}
