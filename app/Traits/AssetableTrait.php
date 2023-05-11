<?php

namespace App\Traits;

use App\Enums\AssetTypeEnum;
use App\Models\Asset;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait AssetableTrait
{
    public function initializeAssetableTrait()
    {
        $this->with[] = 'assets';
        $this->appends[] = 'main_photo';
    }

    public function assets(): MorphMany
    {
        return $this
            ->morphMany(Asset::class, 'assetable')
            ->orderBy('created_at', 'desc');
    }

    public function getMainPhotoAttribute(): ?Asset
    {
        return $this
            ->assets()
            ->where('type', AssetTypeEnum::MAIN_PHOTO)
            ->first();
    }
}
