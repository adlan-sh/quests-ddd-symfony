<?php

declare(strict_types=1);

namespace App\Shared\Application\Listener;

use App\Shared\Application\Exception\ExceptionMapping;
use App\Shared\Application\Resolver\ExceptionMappingResolver;
use App\Shared\Application\Response\ResponseFactory;
use App\Shared\Application\UseCase\ExceptionCommandResult;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;

readonly class ApiExceptionListener
{
    public function __construct(
        private ExceptionMappingResolver $exceptionMappingResolver
    ) {
    }

    public function __invoke(ExceptionEvent $event): void
    {
        $throwable = $event->getThrowable();
        $mapping = $this->exceptionMappingResolver->resolve($throwable::class);

        if (null === $mapping) {
            $mapping = new ExceptionMapping(Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        $result = new ExceptionCommandResult($throwable->getMessage(), $mapping->getCode());

        $response = ResponseFactory::createErrorResponse(['message' => $result->getResult()], $result->getCode());

        $event->setResponse($response);
    }
}
