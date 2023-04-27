<?php

namespace App\Models;

use App\Traits\LoggableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\TourGuideModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class AccessEquipment extends TourGuideModel
{
    use HasFactory, LoggableTrait, SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'notes'
    ];

    protected $casts = [

    ];
}
