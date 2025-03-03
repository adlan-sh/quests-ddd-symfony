<?php

namespace App\User\Application\Security;

use App\User\Domain\Exception\UserNotFoundException;
use Symfony\Bundle\SecurityBundle\Security;
use Webmozart\Assert\Assert;

readonly class UserFetcher implements UserFetcherInterface
{
    public function __construct(private Security $security)
    {
    }

    public function getAuthUser(): AuthUserInterface
    {
        /** @var AuthUserInterface $user */
        $user = $this->security->getUser();

        if (null === $user) {
            throw new UserNotFoundException();
        }

        Assert::isInstanceOf($user, AuthUserInterface::class, 'Invalid user type');

        return $user;
    }
}
