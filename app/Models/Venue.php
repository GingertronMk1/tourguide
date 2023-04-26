<?php

namespace App\Models;

use App\Traits\LoggableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Venue extends Model
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

    public function getRegion(): BelongsTo
    {
        return $this->belongsTo(Region::class);
    }

    public function getArea(): BelongsTo
    {
        return $this->region->getArea();
    }

    public function getVenueType(): BelongsTo
    {
        return $this->belongsTo(VenueType::class);
    }

    public function getAccessEquipment(): BelongsToMany
    {
        return $this->belongsToMany(AccessEquipment::class);
    }

    public function getDealTypes(): BelongsToMany
    {
        return $this->belongsToMany(DealType::class);
    }
}
