<?php

declare(strict_types=1);

namespace App\Review\Domain\Exception;

class ReviewAlreadyExistsException extends \RuntimeException
{
    public function __construct()
    {
        parent::__construct('A review from this user already exists.');
    }
}
