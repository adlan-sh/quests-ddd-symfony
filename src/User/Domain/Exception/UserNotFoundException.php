<?php

declare(strict_types=1);

namespace App\User\Domain\Exception;

class UserNotFoundException extends \RuntimeException
{
    public function __construct()
    {
        parent::__construct('User not found');
    }
}
