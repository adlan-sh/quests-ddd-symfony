<?php

declare(strict_types=1);

namespace App\User\Application\UseCase\EditPassword;

use App\Shared\Application\Command\Command;

readonly class EditPasswordCommand extends Command
{
    public function __construct(
        public string $newPassword,
        public string $confirmPassword
    ) {
    }
}
