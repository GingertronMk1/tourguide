<?php

namespace App\Models;

use App\Traits\LoggableTrait;
use App\Traits\SystemModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class DealType extends TourGuideModel
{
    use HasFactory, LoggableTrait, SoftDeletes, SystemModelTrait;

    public const SYSTEM_HIRE = 1;
    public const SYSTEM_SPLIT = 2;
    public const SYSTEM_GUARANTEE = 3;

    protected $fillable = [
        'name',
        'description',
        'notes',
    ];

    protected $casts = [

    ];
}
