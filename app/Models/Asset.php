<?php

namespace App\Models;

use App\Traits\LoggableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use RuntimeException;

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
        try {
            return Storage::temporaryUrl($this->path, now()->addMinutes(30));
        } catch (RuntimeException $e) {
            return Storage::url($this->path);
        }
    }

    public function getThumbnailURLAttribute(): array
    {
        [$base, $specific] = explode('/', $this->mime_type);

        $type = 'font-awesome';
        $value = 'fa-solid fa-file';

        switch ($base) {

            case 'image': // If it's an image we can probably just show it
                $type = 'url';
                $value = $this->file_url;
                break;

            case 'application': // If it's some other kind of file deal with that
                switch ($specific) {
                    case 'pdf': $value = 'fa-solid fa-file-pdf';
                        break;
                }
                break;

            case 'audio': // If it's an audio file, deal with that
                $value = 'fa-solid fa-file-audio';
                break;
        }

        return compact('type', 'value');
    }
}
