<?php

namespace App\Traits;


trait SystemModelTrait
{
    public static function getSystemType(int $system): ?static
    {
        return static::where('system', '=', $system)->first();
    }
}
