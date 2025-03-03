<?php

declare(strict_types=1);

namespace App\Shared\Application\Model;

class FileDTO implements \JsonSerializable
{
    public function __construct(private string $name, private string $url)
    {
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    public function toArray(): array
    {
        return [
            'name' => $this->getName(),
            'url' => $this->getUrl(),
        ];
    }

    public function jsonSerialize(): array
    {
        return [
            'path' => $this->url,
        ];
    }
}
