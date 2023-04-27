<?php

namespace App\Models;

use App\Traits\LoggableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\TourGuideModel;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\SoftDeletes;

class Area extends TourGuideModel
{
    use HasFactory, LoggableTrait, SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'notes'
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
