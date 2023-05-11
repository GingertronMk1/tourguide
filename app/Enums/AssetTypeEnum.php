<?php

namespace App\Enums;

enum AssetTypeEnum: string
{
    case MAIN_PHOTO = 'Main Photo';
    case ADDITIONAL_PHOTO = 'Additional Photo';
    case TECHNICAL_DOCUMENT = 'Technical Document';
    case OTHER_DOCUMENT = 'Other Document';
}
