<?php

declare(strict_types=1);

namespace App\Shared\Application\Exception;

use Symfony\Component\HttpFoundation\Response;

class RequestQueryConvertException extends ApiException
{
    public function __construct()
    {
        parent::__construct('Error converting request query.', Response::HTTP_BAD_REQUEST);
    }
}
