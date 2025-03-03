<?php

declare(strict_types=1);

namespace App\Shared\Application\Response;

use App\Shared\Application\Resource\ResourceInterface;

class ResponseFactory
{
    public static function createSuccessResponse(
        ResourceInterface|array $data,
        int $code = 200
    ): SuccessResponse {
        if ($data instanceof ResourceInterface) {
            $data = $data->toArray();
        }

        return new SuccessResponse($data, $code);
    }

    public static function createErrorResponse(
        array|ResourceInterface $data,
        int $code = 400
    ): ErrorResponse {
        if ($data instanceof ResourceInterface) {
            $data = $data->toArray();
        }

        return new ErrorResponse($data, $code);
    }
}
