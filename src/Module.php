<?php

namespace Modularis;

use Illuminate\Support\Arr;
use Modularis\Concerns\EnumeratesProperties;
use Modularis\Contracts\ModuleContract;
use Modularis\Contracts\ModuleTypeContract;

final class Module implements ModuleContract
{
    use EnumeratesProperties;

    public function __construct(
        protected string $slug,
        protected ModuleTypeContract $type,
        protected array $name,
        protected ?array $description,
        protected int $priority,
        protected int $display_order,
        protected string $provider,
        protected string $version,
        protected ?string $db_version,
        protected bool $active,
    ) {}

    public function getSlug(): string
    {
        return $this->slug;
    }

    public function getType(): ModuleTypeContract
    {
        return $this->type;
    }

    public function getName(): string
    {
        return $this->name[app()->getLocale()] ?? Arr::first($this->name);
    }

    public function getAllNames(): array
    {
        return $this->name;
    }

    public function getDescription(): ?string
    {
        return $this->description !== null ?
            ($this->description[app()->getLocale()] ?? Arr::first($this->description)) : null;
    }

    public function getAllDescriptions(): array
    {
        return $this->description ?? [];
    }

    public function getPriority(): int
    {
        return $this->priority;
    }

    public function getDisplayOrder(): int
    {
        return $this->display_order;
    }

    public function getVersion(): string
    {
        return $this->version;
    }

    public function getProviderClass(): string
    {
        return $this->provider;
    }

    public function isActive(): bool
    {
        return $this->active;
    }
}
