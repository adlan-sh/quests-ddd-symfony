<?php

declare(strict_types=1);

namespace App\User\Domain\Exception;

class UserAlreadyExistsException extends \RuntimeException
{
    public function __construct()
    {
        parent::__construct('User with that email/phone already exists');
    }
}
