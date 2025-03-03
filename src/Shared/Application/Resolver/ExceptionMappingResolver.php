<?php

declare(strict_types=1);

namespace App\Shared\Application\Resolver;

use App\Shared\Application\Exception\ExceptionMapping;

class ExceptionMappingResolver
{
    private array $mappings;

    public function __construct(array $mappings)
    {
        foreach ($mappings as $class => $mapping) {
            if (empty($mapping['code'])) {
                throw new \InvalidArgumentException('Code is required for class '.$class);
            }

            $this->mappings[$class] = new ExceptionMapping($mapping['code']);
        }
    }

    public function resolve(string $throwableClass): ?ExceptionMapping
    {
        $foundMapping = null;

        foreach ($this->mappings as $class => $mapping) {
            if ($throwableClass === $class || is_subclass_of($throwableClass, $class)) {
                $foundMapping = $mapping;
                break;
            }
        }

        return $foundMapping;
    }
}
