<?php

declare(strict_types=1);

namespace App\User\Application\UseCase\ConfirmUserAccount;

use App\Shared\Application\Command\Command;

readonly class ConfirmUserAccountCommand extends Command
{
    public function __construct(public string $code)
    {
    }
}
