<?php

declare(strict_types=1);

namespace App\Shared\Application\Exception;

use Symfony\Component\HttpFoundation\Response;

class RequestBodyConvertException extends ApiException
{
    public function __construct($message)
    {
        parent::__construct('Error converting request body '.$message, Response::HTTP_BAD_REQUEST);
    }
}
