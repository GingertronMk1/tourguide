<?php

declare(strict_types=1);

namespace App\Models;

use App\Traits\LoggableTrait;
use App\Traits\SystemModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Region extends TourGuideModel
{
    use HasFactory;
    use LoggableTrait;
    use SoftDeletes;
    use SystemModelTrait;

    protected $fillable = [
        'name',
        'description',
        'notes',
    ];

    protected $casts = [
    ];

    public function area(): BelongsTo
    {
        return $this->belongsTo(Area::class);
    }

    public function venues(): HasMany
    {
        return $this->hasMany(Venue::class)->orderBy('name');
    }
}
