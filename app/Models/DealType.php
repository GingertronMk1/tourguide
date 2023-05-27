<?php

declare(strict_types=1);

namespace App\Models;

use App\Traits\LoggableTrait;
use App\Traits\SystemModelTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class DealType extends TourGuideModel
{
    use HasFactory;
    use LoggableTrait;
    use SoftDeletes;
    use SystemModelTrait;

    public const SYSTEM_HIRE = 1;

    public const SYSTEM_SPLIT = 2;

    public const SYSTEM_GUARANTEE = 3;

    protected $fillable = [
        'name',
        'description',
        'notes',
    ];

    protected $casts = [
    ];

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope('order', function (Builder $builder) {
            $builder->orderBy('name');
        });
    }
}
