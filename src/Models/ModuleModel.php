<?php

namespace Modularis\Models;

use Illuminate\Database\Eloquent\Model;
use Modularis\Enums\ModuleType;
use Spatie\Translatable\HasTranslations;

class ModuleModel extends Model
{
    use HasTranslations;

    protected $table = 'modules';

    public array $translatable = ['name', 'description'];

    protected $fillable = [
        'name',
        'slug',
        'type',
        'description',
        'active',
        'version'
    ];

    protected $casts = [
        'type' => ModuleType::class,
        'active' => 'boolean'
    ];

    public static function findBySlug(string $slug): ?self
    {
        return static::where('slug', $slug)->first();
    }
}
