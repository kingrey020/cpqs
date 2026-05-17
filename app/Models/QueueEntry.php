<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;

class QueueEntry extends Model
{
    protected $fillable = [
    'patient_id',
    'queue_number',
    'visit_date',
    'status',
    'priority',
    'called_at',
];


    protected $casts = [
        'called_at' => 'datetime',
        'served_at' => 'datetime',
        'queue_date' => 'date',
    ];

    /**
     * Get the patient that owns this queue entry
     */
    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }

    /**
     * Scope to get today's queue entries
     */
    public function scopeToday($query)
    {
        return $query->whereDate('queue_date', today());
    }

    /**
     * Scope to get waiting entries
     */
    public function scopeWaiting($query)
    {
        return $query->where('status', 'waiting');
    }

    /**
     * Scope to get active entries (waiting, called, serving)
     */
    public function scopeActive($query)
    {
        return $query->whereIn('status', ['waiting', 'called', 'served']);
    }

    /**
     * Calculate estimated waiting time
     */
    public function calculateEstimatedWaitTime(): int
    {
        $averageServiceTime = 15; // minutes (default)
        
        $waitingBefore = self::where('queue_date', $this->queue_date)
            ->where('queue_number', '<', $this->queue_number)
            ->whereIn('status', ['waiting', 'called', 'served'])
            ->count();

        return $waitingBefore * $averageServiceTime;
    }

    /**
     * Get the current serving queue number for today
     */
    public static function getCurrentServing(): ?int
    {
        $current = self::today()
            ->where('status', 'serving')
            ->orderBy('queue_number')
            ->first();

        return $current ? $current->queue_number : null;
    }

    /**
     * Get the next queue number for today
     */
    public static function getNextQueueNumber(): int
    {
        $last = self::whereDate('queue_date', today())
            ->orderBy('queue_number', 'desc')
            ->first();

        return $last ? $last->queue_number + 1 : 1;
    }
}
