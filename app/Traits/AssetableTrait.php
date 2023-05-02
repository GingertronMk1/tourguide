<?php

namespace App\Traits;

use App\Models\Asset;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait LoggableTrait
{
    public function getAssets(): HasMany
    {
        return $this->hasMany(Asset::class);
    }
}
