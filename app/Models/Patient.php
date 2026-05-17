<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Patient extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'date_of_birth',
        'address',
        'service',
        'complaint',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
    ];

    /**
     * Get all queue entries for this patient
     */
    public function queueEntries(): HasMany
    {
        return $this->hasMany(QueueEntry::class);
    }

    /**
     * Get the latest queue entry for today
     */
    public function todayQueueEntry()
    {
        return $this->queueEntries()
            ->whereDate('queue_date', today())
            ->latest()
            ->first();
    }
}
