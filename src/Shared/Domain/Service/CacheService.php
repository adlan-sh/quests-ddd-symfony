<?php

declare(strict_types=1);

namespace App\Shared\Domain\Service;

use Symfony\Component\Serializer\SerializerInterface;

readonly class CacheService implements CacheServiceInterface
{
    private int $ttl;

    private \Redis $redis;

    public function __construct(string $host, int $port, int $ttl, private SerializerInterface $serializer)
    {
        $this->redis = new \Redis(
            ['host' => $host, 'port' => $port]
        );
        $this->ttl = $ttl;
    }

    public function exists(string $key): bool
    {
        return (bool) $this->redis->exists($key);
    }

    public function get(string $key, string $class): mixed
    {
        return $this->serializer->deserialize(
            $this->redis->get($key),
            $class,
            'json'
        );
    }

    public function set(string $key, mixed $value): void
    {
        $data = $this->serializer->serialize($value, 'json');

        $this->redis->setex($key, $this->ttl, $data);
    }
}
