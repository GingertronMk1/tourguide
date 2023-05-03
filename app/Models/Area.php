<?php

namespace App\Models;

use App\Traits\LoggableTrait;
use App\Traits\SystemModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\SoftDeletes;

class Area extends TourGuideModel
{
    use HasFactory, LoggableTrait, SoftDeletes, SystemModelTrait;

    public const SYSTEM_NORTH = 1;
    public const SYSTEM_MIDLANDS = 2;
    public const SYSTEM_SOUTH_EAST = 3;
    public const SYSTEM_SOUTH_WEST = 4;
    public const SYSTEM_LONDON = 5;

    protected $fillable = [
        'name',
        'description',
        'notes',
    ];

    protected $casts = [

    ];

    public function regions(): HasMany
    {
        return $this->hasMany(Region::class)->orderBy('name');
    }

    public function venues(): HasManyThrough
    {
        return $this->hasManyThrough(Venue::class, Region::class)->orderBy('name');
    }
}
