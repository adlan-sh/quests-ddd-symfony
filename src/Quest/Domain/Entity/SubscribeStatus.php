<?php

declare(strict_types=1);

namespace App\Quest\Domain\Entity;

enum SubscribeStatus: int
{
    case Success = 0;

    case AlreadySubscribed = 1;

    case Full = 2;

    case NonSubscribed = 3;
}
