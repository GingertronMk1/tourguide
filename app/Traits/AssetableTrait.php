<?php

namespace App\Traits;

use App\Models\Asset;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait AssetableTrait
{
    public function initializeAssetableTrait()
    {
        $this->with[] = 'assets';
    }

    public function assets(): MorphMany
    {
        return $this->morphMany(Asset::class, 'assetable');
    }
}
