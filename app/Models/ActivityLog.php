<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ActivityLog extends Model
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

    public function getUser(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getLoggable(): BelongsTo
    {
        return $this->belongsTo($this->loggable_type);
    }
}
