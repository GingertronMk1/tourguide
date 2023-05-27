<?php

namespace App\Models;

use App\Traits\LoggableTrait;
use App\Traits\SystemModelTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class VenueType extends TourGuideModel
{
    use HasFactory, LoggableTrait, SoftDeletes, SystemModelTrait;

    public const SYSTEM_THEATRE = 1;

    public const SYSTEM_ARTS_CENTRE = 2;

    public const SYSTEM_OUTDOOR_THEATRE = 3;

    public const SYSTEM_COMMUNITY_VENUE = 4;

    public const SYSTEM_LIBRARY = 5;

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope('order', function (Builder $builder) {
            $builder->orderBy('name');
        });
    }

    protected $fillable = [
        'name',
        'description',
        'notes',
    ];

    protected $casts = [

    ];
}
