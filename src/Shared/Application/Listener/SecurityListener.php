<?php

declare(strict_types=1);

namespace App\Shared\Application\Listener;

use Psr\Log\LoggerInterface;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;

readonly class SecurityListener
{
    public function __construct(private LoggerInterface $logger)
    {
    }

    public function onSecurityInteractiveLogin(InteractiveLoginEvent $event): void
    {
        $user = $event->getAuthenticationToken()->getUser();

        $this->logger->info("User with email {$user?->getUserIdentifier()} was signed in", ['login' => true]);
    }
}
