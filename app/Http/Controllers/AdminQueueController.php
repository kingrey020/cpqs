<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\QueueEntry;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AdminQueueController extends Controller
{
    /**
     * Display the Admin Dashboard with Analytics and Metrics
     */
    public function dashboard()
    {
        $today = Carbon::today()->toDateString();

        $totalPatientsToday = QueueEntry::where('visit_date', $today)->count();

        $patientsWaiting = QueueEntry::where('visit_date', $today)
            ->where('status', 'waiting')
            ->count();

        $currentlyServing = QueueEntry::where('visit_date', $today)
            ->whereIn('status', ['called', 'serving'])
            ->count();

        $completedToday = QueueEntry::where('visit_date', $today)
            ->where('status', 'completed')
            ->count();

        // Get service breakdown (Groups by Service/Department)
        $serviceBreakdown = QueueEntry::with('patient')
            ->where('visit_date', $today)
            ->get()
            ->groupBy(function($entry) {
                return $entry->patient->service ?? 'Not Specified';
            })
            ->map(function($group) {
                return $group->count();
            });

        // Get complaint breakdown (Groups by Purpose of Visit)
        $complaintBreakdown = QueueEntry::with('patient')
            ->where('visit_date', $today)
            ->get()
            ->groupBy(function($entry) {
                return $entry->patient->complaint ?? 'Not Specified';
            })
            ->map(function($group) {
                return $group->count();
            });

        // Get the next 10 waiting patients for the dashboard preview
        $waitingPatients = QueueEntry::with('patient')
            ->where('visit_date', $today)
            ->where('status', 'waiting')
            ->orderBy('created_at')
            ->limit(10)
            ->get();

        return view('admin.dashboard', compact(
            'totalPatientsToday',
            'patientsWaiting',
            'currentlyServing',
            'completedToday',
            'serviceBreakdown',
            'complaintBreakdown',
            'waitingPatients'
        ));
    }

    /**
     * Display the Live Queue Management Table
     */
    public function index(Request $request)
    {
        $today = Carbon::today()->toDateString();

        // Start Query
        $query = QueueEntry::with('patient')->where('visit_date', $today);

        // Handle Backend Status Tabs Filter (if JS fails or user reloads)
        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        // Handle Backend Search Bar Input
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('queue_number', 'like', "%{$search}%")
                  ->orWhereHas('patient', function($patientQuery) use ($search) {
                      $patientQuery->where('name', 'like', "%{$search}%")
                                   ->orWhere('service', 'like', "%{$search}%");
                  });
            });
        }

        // Get all entries ordered by when they joined the queue
        $entries = $query->orderBy('created_at', 'asc')->get();

        // Find the patient currently at the counter
        $currentCalled = QueueEntry::where('visit_date', $today)
            ->whereIn('status', ['called', 'serving'])
            ->orderByDesc('updated_at')
            ->first();

        return view('admin.index', compact('entries', 'currentCalled'));
    }

    /**
     * Automatically call the next patient in line
     */
    public function callNext()
    {
        $today = Carbon::today()->toDateString();
        $next = null;

        DB::transaction(function () use ($today, &$next) {
            $next = QueueEntry::where('visit_date', $today)
                ->where('status', 'waiting')
                ->orderBy('created_at')
                ->lockForUpdate()
                ->first();

            if ($next) {
                $next->status = 'called';
                $next->save();
            }
        });

        if (!$next) {
            return redirect()->route('admin.queue.index')->with('error', 'No waiting patients in the queue.');
        }

        return redirect()->route('admin.queue.index')->with('success', "Patient {$next->queue_number} has been called to the counter.");
    }

    /**
     * Mark a currently called patient as completed/served
     */
    public function serve(int $id)
    {
        $entry = QueueEntry::findOrFail($id);

        if (in_array($entry->status, ['called', 'serving'])) {
            $entry->status = 'completed';
            $entry->save();
        }

        return redirect()->route('admin.queue.index')->with('success', "Patient {$entry->queue_number} marked as completed.");
    }

    /**
     * Skip a patient (Moves them to the back of the waiting line)
     */
    public function skip(int $id)
    {
        $entry = QueueEntry::findOrFail($id);

        if (in_array($entry->status, ['waiting', 'called'])) {
            // Put them back to 'waiting' and reset their timestamp to NOW 
            // so they drop to the bottom of the queue list.
            $entry->status = 'waiting';
            $entry->created_at = now(); 
            $entry->save();
        }

        return redirect()->route('admin.queue.index')->with('success', "Patient {$entry->queue_number} has been skipped and moved to the back of the queue.");
    }

    /**
     * Cancel a waiting or called entry entirely
     */
    public function cancel(int $id)
    {
        $entry = QueueEntry::findOrFail($id);

        if (in_array($entry->status, ['waiting', 'called'])) {
            $entry->status = 'cancelled';
            $entry->save();
        }

        return redirect()->route('admin.queue.index')->with('success', "Queue entry for {$entry->queue_number} has been cancelled.");
    }

    /**
     * Permanently delete a record from the database
     */
    public function destroy(int $id)
    {
        $entry = QueueEntry::findOrFail($id);
        $queueNumber = $entry->queue_number;
        
        $entry->delete();

        return redirect()->route('admin.queue.index')->with('success', "Record {$queueNumber} has been permanently deleted.");
    }
}