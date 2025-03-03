<?php

declare(strict_types=1);

namespace App\Quest\Application\UseCase\GetQuest;

use App\Quest\Application\Model\QuestDTO;
use App\Shared\Application\UseCase\CommandResultInterface;

readonly class GetQuestCommandResult implements CommandResultInterface
{
    public function __construct(private QuestDTO $questDTO, private int $code)
    {
    }

    public function getResult(): array
    {
        return [
            'id' => $this->questDTO->getId(),
            'name' => $this->questDTO->getName(),
            'description' => $this->questDTO->getDescription(),
            'tags' => $this->questDTO->getTags()->getValues(),
            'code' => $this->questDTO->getCode(),
            'seatsCount' => $this->questDTO->getSeatsCount(),
            'theme' => $this->questDTO->getThemes()->getValues(),
            'genre' => $this->questDTO->getGenre(),
            'dateEvent' => $this->questDTO->getDateEvent()->format('d-m-Y'),
            'dateFinalAppointment' => $this->questDTO->getDateFinalAppointment()->format('d-m-Y'),
            'gallery' => $this->questDTO->getGallery()->getValues(),
        ];
    }

    public function getCode(): int
    {
        return $this->code;
    }
}
