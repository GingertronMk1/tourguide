<?php

declare(strict_types=1);

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
            ->orderBy('created_at', 'desc')
        ;
    }

    public function photoAssets(): MorphMany
    {
        return $this
            ->assets()
            ->whereIn('type', AssetTypeEnum::PHOTO_TYPES)
        ;
    }

    public function getMainPhotoAttribute(): ?Asset
    {
        return $this
            ->assets()
            ->where('type', AssetTypeEnum::MAIN_PHOTO)
            ->first()
        ;
    }
}
