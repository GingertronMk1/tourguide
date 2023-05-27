<?php

declare(strict_types=1);

namespace App\Models;

use App\Traits\AssetableTrait;
use App\Traits\LoggableTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property string $name
 * @property string $description
 * @property string $notes
 * @property string $street_address
 * @property string $city
 * @property int $region_id
 * @property int $venue_type_id
 * @property int $maximum_stage_width
 * @property int $maximum_stage_depth
 * @property int $maximum_stage_height
 * @property int $maximum_seats
 * @property int $maximum_wheelchair_seats
 * @property int $number_of_dressing_rooms
 * @property bool $backstage_wheelchair_access
 * @property Region $region
 * @property Area $area
 * @property AccessEquipment[] $accessEquipment
 * @property DealType[] $dealTypes
 */
class Venue extends TourGuideModel
{
    public const PER_PAGE = 25;

    use HasFactory, LoggableTrait, SoftDeletes, AssetableTrait;

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
        'backstage_wheelchair_access' => 'boolean',
    ];

    protected $with = [
        'venueType',
        'region',
        'accessEquipment',
        'dealTypes',
    ];

    public function region(): BelongsTo
    {
        return $this->belongsTo(Region::class);
    }

    public function area(): BelongsTo
    {
        return $this->region?->area();
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

    public function scopeWithAccessEquipment(Builder $query, array $equipmentIds): void
    {
        $equipmentCount = count($equipmentIds);
        if ($equipmentCount > 0) {
            $query->whereHas(
                'accessEquipment',
                function (Builder $query) use ($equipmentIds) {
                    $query->whereIn(AccessEquipment::getTableColumn('id'), $equipmentIds);
                },
                '=',
                $equipmentCount
            );
        }
    }

    public function scopeWithDealTypes(Builder $query, array $dealTypeIds): void
    {
        $dealTypeCount = count($dealTypeIds);
        if ($dealTypeCount > 0) {
            $query->whereHas(
                'dealTypes',
                function (Builder $query) use ($dealTypeIds) {
                    $query->whereIn(DealType::getTableColumn('id'), $dealTypeIds);
                },
                '=',
                $dealTypeCount
            );
        }
    }
}
