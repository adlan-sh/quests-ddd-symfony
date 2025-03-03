<?php

declare(strict_types=1);

namespace App\User\Application\Listener;

use App\Shared\Domain\Service\CacheServiceInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Event\AuthenticationSuccessEvent;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

readonly class JWTAuthenticatedListener
{
    public function __construct(private CacheServiceInterface $cacheService)
    {
    }

    public function onAuthenticationSuccessResponse(AuthenticationSuccessEvent $event): void
    {
        $token = $event->getData()['token'];

        $ttl = (new \DateTimeImmutable())->add(new \DateInterval('PT30M'));

        $this->cacheService->set('users:'.$token, $ttl->getTimestamp());
    }

    public function onKernelRequest(RequestEvent $event): void
    {
        if ('/api/v1/user/signUp' === $event->getRequest()->getRequestUri()) {
            return;
        }

        $bearer = $event->getRequest()->headers->get('authorization');
        $token = str_replace('Bearer ', '', $bearer);

        $timestamp = $this->cacheService->get('users:'.$token, 'int');

        if ($timestamp < (new \DateTimeImmutable())->getTimestamp()) {
            throw new UnauthorizedHttpException('Bearer token has expired', 'Bearer token has expired');
        }
    }
}
