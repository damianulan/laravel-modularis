<?php

namespace Modularis\Concerns;

use BackedEnum;
use Illuminate\Contracts\Support\Arrayable;
use ReflectionClass;

trait EnumeratesProperties
{
    public function all(): array
    {
        return $this->getProperties();
    }

    public function toArray(): array
    {
        return $this->getProperties(true);
    }

    private function getProperties(bool $serialize = false): array
    {
        $values = [];

        foreach ((new ReflectionClass($this))->getProperties() as $property) {
            if ($property->isStatic()) {
                continue;
            }

            $values[$property->getName()] = $this->serializeValue($property->getValue($this));
        }

        return $values;
    }

    private function serializeValue(mixed $value): mixed
    {
        return match (true) {
            $value instanceof BackedEnum => $value->value,
            $value instanceof Arrayable => $value->toArray(),
            is_object($value) => (array) $value,
            default => $value,
        };
    }
}
