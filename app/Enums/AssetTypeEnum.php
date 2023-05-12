<?php

namespace App\Enums;

enum AssetTypeEnum: string
{
    case MAIN_PHOTO = 'Main Photo';
    case ADDITIONAL_PHOTO = 'Additional Photo';
    case TECHNICAL_DOCUMENT = 'Technical Document';
    case OTHER_DOCUMENT = 'Other Document';
    case DETAILS_DOCUMENT = 'Details Document';

    public const PHOTO_TYPES = [
        self::MAIN_PHOTO,
        self::ADDITIONAL_PHOTO,
    ];

    private const NON_USER_TYPES = [
        self::DETAILS_DOCUMENT,
    ];

    public static function getPropAssetTypes(): array
    {
        return array_filter(
            static::cases(),
            fn (AssetTypeEnum $assetType) => ! in_array($assetType, static::NON_USER_TYPES)
        );
    }
}
