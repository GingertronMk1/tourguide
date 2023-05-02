<?php

namespace App\Models;

use App\Traits\LoggableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\UploadedFile;

class Asset extends TourGuideModel
{
    use HasFactory, LoggableTrait, SoftDeletes;

    protected $fillable = [

    ];

    protected $casts = [
        'metadata' => 'json',
    ];

    public function getFile()
    {
        return asset($this->path);
    }

    public function assetable(): BelongsTo
    {
        return $this->belongsTo($this->assetable_type);
    }

    public static function createNew(
        UploadedFile $file,
        TourGuideModel $model,
        string $type,
        ?array $metadata = []
    ): self {
        $storedFile = $file->store('assets');
        if (! $storedFile) {
            throw new \Exception('Failed storing file');
        }

        return new self([
            'type' => $type,
            'path' => $storedFile,
            'assetable_id' => $model->id,
            'assetable_type' => get_class($model),
            'metadata' => $metadata,
        ]);
    }
}
