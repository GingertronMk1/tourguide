<?php

namespace App\Traits;

use App\Models\ActivityLog;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;

trait LoggableTrait {

    public static function bootLoggable(): void
    {
        static::created(function(mixed $loggable) {
             $log = new ActivityLog();
             $log->user_id = Auth::user()?->id;
             $log->loggable_type = get_class($loggable);
             $log->loggable_id = $loggable->id;
             $log->changed_data = $loggable->toArray();
             $log->type = ActivityLog::TYPE_CREATED;
             $log->save();
        });
    }

    public function getLogs(): HasMany
    {
        return $this->hasMany(ActivityLog::class);
    }
}
