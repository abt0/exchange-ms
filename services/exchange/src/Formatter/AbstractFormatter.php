<?php

declare(strict_types=1);

namespace App\Formatter;

abstract class AbstractFormatter
{
    abstract protected static function entityClass(): string;
    abstract protected function formatFunction(object $entity): array;

    public function formatOne(object $entity): array
    {
        $class = static::entityClass();

        if (!$entity instanceof $class) {
            throw new \InvalidArgumentException('Entity should be an instance of ' . $class);
        }

        return $this->formatFunction($entity);
    }

    public function formatAll(array $entities): array
    {
        return array_map([$this, 'formatOne'], $entities);
    }
}
