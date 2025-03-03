<?php

namespace App\Shared\Application\Mapper;

use App\Shared\Application\Model\FileDTO;
use App\Shared\Domain\Entity\File;
use App\Shared\Domain\ValueObject\Photo;

class FileMapper
{
    public static function toPhoto(array $file): Photo
    {
        return new Photo(
            $file['url']
        );
    }

    public static function toFileDTO(File|array $file): FileDTO
    {
        if ($file instanceof File) {
            return new FileDTO($file->getName(), $file->getUrl());
        }

        return new FileDTO($file['name'], $file['url']);
    }
}
