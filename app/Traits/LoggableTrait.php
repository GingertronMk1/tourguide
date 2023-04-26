<?php

namespace App\Traits;

use App\Models\ActivityLog;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;

trait LoggableTrait
{

    public static function bootLoggableTrait(): void
    {
        static::created(function (mixed $loggable) {
            $log = new ActivityLog();
            $log->user_id = Auth::user()?->id;
            $log->loggable_type = get_class($loggable);
            $log->loggable_id = $loggable->id;
            $log->old_data = [];
            $log->new_data = $loggable->toArray();
            $log->event_type = ActivityLog::TYPE_CREATED;
            $log->save();
        });

        static::updated(function (mixed $loggable) {
            $log = new ActivityLog();
            $log->user_id = Auth::user()?->id;
            $log->loggable_type = get_class($loggable);
            $log->loggable_id = $loggable->id;
            $log->old_data = $loggable->getOriginal();
            $log->new_data = $loggable->toArray();
            $log->event_type = ActivityLog::TYPE_UPDATED;
            $log->save();
        });

        static::deleted(function (mixed $loggable) {
            $log = new ActivityLog();
            $log->user_id = Auth::user()?->id;
            $log->loggable_type = get_class($loggable);
            $log->loggable_id = $loggable->id;
            $log->old_data = $loggable->getOriginal();
            $log->new_data = [];
            $log->event_type = ActivityLog::TYPE_DELETED;
            $log->save();
        });
    }

    public function getLogs(): HasMany
    {
        return $this->hasMany(ActivityLog::class);
    }
}
