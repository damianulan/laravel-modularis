<?php

namespace Modularis;

use Modularis\Contracts\ModuleContract;
use Modularis\Enums\ModuleType;

final class Module implements ModuleContract
{
    public function __construct(
        protected string $slug,
        protected ModuleType $type,
        protected string $name,
        protected ?string $description,
        protected int $priority,
        protected string $providerClass,
        protected string $version,
        protected ?string $db_version,
        protected bool $active,
    ) {
    }

    public function getSlug(): string
    {
        return $this->slug;
    }

    public function getType(): ModuleType
    {
        return $this->type;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getVersion(): string
    {
        return $this->version;
    }

    public function getProviderClass(): string
    {
        return $this->providerClass;
    }

    public function getActive(): bool
    {
        return $this->active;
    }

    public function toArray()
    {
        return [];
    }
}
