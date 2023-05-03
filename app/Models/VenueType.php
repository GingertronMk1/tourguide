<?php

namespace App\Models;

use App\Traits\LoggableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class VenueType extends TourGuideModel
{
    use HasFactory, LoggableTrait, SoftDeletes;

    public const SYSTEM_THEATRE = 1;
    public const SYSTEM_ARTS_CENTRE = 2;
    public const SYSTEM_OUTDOOR_THEATRE = 3;
    public const SYSTEM_COMMUNITY_VENUE = 4;
    public const SYSTEM_LIBRARY = 5;

    protected $fillable = [
        'name',
        'description',
        'notes',
    ];

    protected $casts = [

    ];

    public static function getSystemType(int $system): static
    {
        return static::where('system', '=', $system)->first();
    }
}
