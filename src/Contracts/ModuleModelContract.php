<?php

namespace Modularis\Contracts;

use Illuminate\Database\Eloquent\Model;

/** @mixin Model */
interface ModuleModelContract
{
    public static function findBySlug(string $slug): ?static;

    public function getSlug(): string;

    public function getDisplayOrder(): int;

    public function getVersion(): string;

    public function isActive(): bool;
}
