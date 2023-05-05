<?php

namespace App\Models;

use App\Traits\LoggableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Asset extends TourGuideModel
{
    use HasFactory, LoggableTrait, SoftDeletes;

    public const TYPE_MAIN_PHOTO = 'photo.main';

    public const TYPE_ADDITIONAL_PHOTO = 'photo.additional';

    public const TYPE_TECHNICAL_DOCUMENT = 'document.technical';

    public const TYPE_OTHER_DOCUMENT = 'document.other';

    public const TYPES = [
        self::TYPE_MAIN_PHOTO => 'Main Photo',
        self::TYPE_ADDITIONAL_PHOTO => 'Additional Photo',
        self::TYPE_TECHNICAL_DOCUMENT => 'Technical Document',
        self::TYPE_OTHER_DOCUMENT => 'Other Document',
    ];

    protected $casts = [
        'metadata' => 'json',
    ];

    protected $attributes = [
        'metadata' => '[]',
    ];

    protected $appends = [
        'file_url',
        'thumbnail_url',
    ];

    public function getFileAttribute()
    {
        return Storage::get($this->path);
    }

    public function assetable(): BelongsTo
    {
        return $this->belongsTo($this->assetable_type);
    }

    public function getFileURLAttribute(): string
    {
        switch (config('filesystems.default')) {
            case 's3':
            case 'r2':
                return Storage::temporaryUrl($this->path, now()->addMinutes(30));
            default:
                return Storage::url($this->path);
        }
    }

    public function getThumbnailURLAttribute(): array
    {
        switch ($this->mime_type) {
            case 'image/jpeg':
            case 'image/jpg':
            case 'image/png':
                return [
                    'type' => 'url',
                    'value' => $this->file_url,
                ];
            case 'application/pdf':
                return [
                    'type' => 'font-awesome',
                    'value' => 'fa-solid fa-file-pdf',
                ];
            default:
                return [
                    'type' => 'font-awesome',
                    'value' => 'fa-solid fa-file',
                ];
        }
    }
}
