<?php

declare(strict_types=1);

namespace App\Quest\Presentation\Resource;

use App\Quest\Application\Model\QuestListItemDTO;

class QuestListItemResource implements \JsonSerializable
{
    public function __construct(private QuestListItemDTO $questItem)
    {
    }

    public function jsonSerialize(): QuestListItemDTO
    {
        return $this->questItem;
    }
}
