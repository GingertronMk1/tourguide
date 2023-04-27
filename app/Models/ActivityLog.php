<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\TourGuideModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ActivityLog extends TourGuideModel
{
    use HasFactory;

    public const TYPE_CREATED = 'created';
    public const TYPE_UPDATED = 'updated';
    public const TYPE_DELETED = 'deleted';

    protected $fillable = [
    ];

    protected $casts = [
        'old_data' => 'json',
        'new_data' => 'json',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function loggable(): BelongsTo
    {
        return $this->belongsTo($this->loggable_type);
    }
}
