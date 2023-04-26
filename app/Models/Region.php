<?php

namespace App\Models;

use App\Traits\LoggableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Region extends Model
{
    use HasFactory, LoggableTrait, SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'notes'
    ];

    protected $casts = [

    ];

    public function getArea(): BelongsTo
    {
        return $this->belongsTo(Area::class);
    }
}
