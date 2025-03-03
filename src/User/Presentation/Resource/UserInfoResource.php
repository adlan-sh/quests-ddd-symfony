<?php

namespace App\User\Presentation\Resource;

use App\Shared\Application\Resource\ResourceInterface;
use App\Shared\Application\UseCase\CommandResultInterface;

readonly class UserInfoResource implements ResourceInterface
{
    public function __construct(
        private CommandResultInterface $commandResult
    ) {
    }

    public function toArray(): array
    {
        $result = $this->commandResult->getResult();

        return [
            'data' => [
                'firstName' => $result['firstName'],
                'lastName' => $result['lastName'],
                'middleName' => $result['middleName'],
                'email' => $result['email'],
                'phone' => $result['phone'],
                'photo' => $result['photo'],
            ],
        ];
    }

    public function getCode(): int
    {
        return $this->commandResult->getCode();
    }
}
