<?php

declare(strict_types=1);

namespace App\Review\Domain\Exception;

class ReviewNotFoundException extends \RuntimeException
{
    public function __construct()
    {
        parent::__construct('Review not found.');
    }
}
