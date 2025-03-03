<?php

namespace App\Shared\Domain\Repository;

use App\Shared\Domain\Entity\File;

interface FileRepositoryInterface
{
    /**
     * Возвращает UUID файла.
     */
    public function create(array $file): File;

    public function getById(string $id): ?File;
}
