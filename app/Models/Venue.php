<?php

namespace App\Models;

use App\Traits\LoggableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\TourGuideModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Venue extends TourGuideModel
{
    use HasFactory, LoggableTrait, SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'notes',
        'street_address',
        'city',
        'region_id',
        'venue_type_id',
        'maximum_stage_width',
        'maximum_stage_depth',
        'maximum_stage_height',
        'maximum_seats',
        'maximum_wheelchair_seats',
        'number_of_dressing_rooms',
        'backstage_wheelchair_access',
    ];

    protected $casts = [
        'backstage_wheelchair_access' => 'boolean'
    ];

    public function region(): BelongsTo
    {
        return $this->belongsTo(Region::class);
    }

    public function venueType(): BelongsTo
    {
        return $this->belongsTo(VenueType::class);
    }

    public function accessEquipment(): BelongsToMany
    {
        return $this->belongsToMany(AccessEquipment::class)->withPivot(['notes'])->withTimestamps();
    }

    public function dealTypes(): BelongsToMany
    {
        return $this->belongsToMany(DealType::class)->withPivot(['notes'])->withTimestamps();
    }
}
