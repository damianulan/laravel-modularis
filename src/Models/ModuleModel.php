<?php

namespace Modularis\Models;

use Illuminate\Database\Eloquent\Model;
use Modularis\Contracts\ModuleModelContract;
use Modularis\Enums\ModuleType;

class ModuleModel extends Model implements ModuleModelContract
{
    protected $table = 'modules';

    protected $fillable = [
        'slug',
        'display_order',
        'version',
        'active'
    ];

    protected $casts = [
        'type' => ModuleType::class,
        'active' => 'boolean'
    ];

    public static function findBySlug(string $slug): ?static
    {
        return static::where('slug', $slug)->first();
    }

    public function getSlug(): string
    {
        return $this->getAttribute('slug');
    }

    public function getDisplayOrder(): int
    {
        return $this->getAttribute('display_order');
    }

    public function getVersion(): string
    {
        return $this->getAttribute('version');
    }

    public function isActive(): bool
    {
        return $this->getAttribute('active');
    }
}
