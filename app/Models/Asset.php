<?php

namespace App\Models;

use App\Enums\AssetTypeEnum;
use App\Traits\LoggableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Asset extends TourGuideModel
{
    use HasFactory, LoggableTrait, SoftDeletes;

    protected $fillable = [
        'title',
        'type',
        'assetable_type',
        'assetable_id',
    ];

    protected $casts = [
        'metadata' => 'json',
        'type' => AssetTypeEnum::class,
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

    public function getFileAsBase64Attribute(): string
    {
        $prefix = "data:{$this->mime_type};base64,";
        try {
            $image = Storage::get($this->path) ?? '';
            $image = base64_encode($image);

            return "{$prefix}{$image}";
        } catch (\Exception) {
            return $prefix;
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
