<?php

declare(strict_types=1);

namespace App\Shared\Application\Exception;

use Symfony\Component\HttpFoundation\Response;

class ValidationException extends ApiException
{
    public function __construct($message)
    {
        parent::__construct($message, Response::HTTP_UNPROCESSABLE_ENTITY);
    }
}
