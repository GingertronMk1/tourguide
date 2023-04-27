<?php

namespace App\Models;

use App\Traits\LoggableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\SoftDeletes;

class Area extends Model
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
