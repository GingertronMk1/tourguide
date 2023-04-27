<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TourGuideModel extends Model
{
    public static function getTableName() {
        return (new static)->getTable();
    }

    protected $fillable = [

    ];

    protected $casts = [

    ];
}
