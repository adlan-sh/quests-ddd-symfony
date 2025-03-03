<?php

declare(strict_types=1);

namespace App\User\Application\UseCase\RegisterUser;

use App\Shared\Application\Command\Command;

readonly class RegisterUserCommand extends Command
{
    public function __construct(
        public string $firstName,
        public string $lastName,
        public ?string $middleName,
        public string $email,
        public ?string $phone,
        public string $password
    ) {
    }
}
