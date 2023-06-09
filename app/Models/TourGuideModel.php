<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TourGuideModel extends Model
{
    protected $fillable = [
    ];

    protected $casts = [
    ];

    protected $appends = ['class_name'];

    public static function getTableName(): string
    {
        return (new static())->getTable();
    }

    public static function getTableColumn(string $column): string
    {
        return static::getTableName().'.'.$column;
    }

    public function getClassNameAttribute(): string
    {
        return static::class;
    }
}
