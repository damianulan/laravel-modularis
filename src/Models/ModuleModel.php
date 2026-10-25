<?php

namespace Modularis\Models;

use Illuminate\Database\Eloquent\Model;
use Modularis\Contracts\ModuleModelContract;
use Modularis\Enums\ModuleType;

/**
 * @property int $id
 * @property string $slug
 * @property int $display_order
 * @property string $version
 * @property bool $active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property ModuleType $type
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModuleModel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModuleModel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModuleModel query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModuleModel whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModuleModel whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModuleModel whereDisplayOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModuleModel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModuleModel whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModuleModel whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModuleModel whereVersion($value)
 * @mixin \Eloquent
 */
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
