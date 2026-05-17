<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\QueueEntry;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PublicQueueController extends Controller
{
    public function showRegistrationForm()
    {
        return view('public.register');
    }

    // Online patient registration
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'     => 'required|string|max:255',
            'phone'        => 'nullable|string|max:50',
            'date_of_birth' => 'nullable|date',
            'visit_date' => 'date',
            'address'    => 'nullable|string|max:100',
            'service'    => 'required|string|max:255',
            'complaint'  => 'required|string|max:255',
        ]);

        // Find or create patient (simple: always create new)
        $patient = Patient::create($data);

        $today = Carbon::today()->toDateString();

        // Get next queue number for today
        $last = QueueEntry::where('visit_date', $today)
            ->orderByDesc('id')
            ->first();

        $nextNumberInt = $last ? (int)$last->queue_number + 1 : 1;
        $queueNumber = str_pad($nextNumberInt, 3, '0', STR_PAD_LEFT);

        $entry = QueueEntry::create([
            'patient_id'   => $patient->id,
            'queue_number' => $queueNumber,
            'visit_date'   => $today,
            'status'       => 'waiting',
        ]);

        // Simple estimated waiting time: 5 min per waiting patient
        $waitingAhead = QueueEntry::where('visit_date', $today)
            ->where('status', 'waiting')
            ->where('id', '<', $entry->id)
            ->count();

        $estimatedMinutes = $waitingAhead * 5;

        return view('public.confirmation', [
            'entry'           => $entry,
            'patient'         => $patient,
            'waitingAhead'    => $waitingAhead,
            'estimatedMinutes'=> $estimatedMinutes,
        ]);
    }

    // Specific patient status by queue number
    public function status(string $queue_number)
    {
        $today = Carbon::today()->toDateString();

        $entry = QueueEntry::with('patient')
            ->where('visit_date', $today)
            ->where('queue_number', $queue_number)
            ->firstOrFail();

        $currentCalled = QueueEntry::where('visit_date', $today)
            ->where('status', 'called')
            ->orderByDesc('called_at')
            ->first();

        $waitingAhead = QueueEntry::where('visit_date', $today)
            ->where('status', 'waiting')
            ->where('id', '<', $entry->id)
            ->count();

        $estimatedMinutes = $waitingAhead * 5;

        return view('public.status', [
            'entry'            => $entry,
            'currentCalled'    => $currentCalled,
            'waitingAhead'     => $waitingAhead,
            'estimatedMinutes' => $estimatedMinutes,
        ]);
    }

    // Public display (for TV or screen)
    public function display()
    {
        $today = Carbon::today()->toDateString();

        $currentCalled = QueueEntry::where('visit_date', $today)
            ->where('status', 'called')
            ->orderByDesc('called_at')
            ->first();

        $nextWaiting = QueueEntry::where('visit_date', $today)
            ->where('status', 'waiting')
            ->orderBy('priority', 'desc')
            ->orderBy('created_at')
            ->take(5)
            ->get();

        return view('public.display', [
            'currentCalled' => $currentCalled,
            'nextWaiting'   => $nextWaiting,
        ]);
    }

    // Show edit form for patient
    public function edit(string $queue_number)
    {
        $today = Carbon::today()->toDateString();

        $entry = QueueEntry::with('patient')
            ->where('visit_date', $today)
            ->where('queue_number', $queue_number)
            ->firstOrFail();

        $services = ['General Consultation', 'Dental', 'Pediatrics', 'Laboratory'];
        $complaints = ['Consultation', 'Follow-up', 'Check-up', 'Prescription refill'];

        return view('public.edit', [
            'entry' => $entry,
            'services' => $services,
            'complaints' => $complaints,
        ]);
    }

    // Update patient information
    public function update(Request $request, string $queue_number)
    {
        $today = Carbon::today()->toDateString();

        $entry = QueueEntry::with('patient')
            ->where('visit_date', $today)
            ->where('queue_number', $queue_number)
            ->firstOrFail();

        // Only allow updates if status is waiting
        if ($entry->status !== 'waiting') {
            return redirect()->route('queue.status', $queue_number)
                ->with('error', 'Cannot update queue information after being called.');
        }

        $data = $request->validate([
            'name'     => 'required|string|max:255',
            'phone'    => 'nullable|string|max:50',
            'date_of_birth' => 'nullable|date',
            'address'  => 'nullable|string|max:100',
            'service'  => 'required|string|max:255',
            'complaint' => 'required|string|max:255',
        ]);

        $entry->patient->update($data);

        return redirect()->route('queue.status', $queue_number)
            ->with('success', 'Your information has been updated successfully.');
    }

    // Cancel queue entry
    public function cancel(string $queue_number)
    {
        $today = Carbon::today()->toDateString();

        $entry = QueueEntry::with('patient')
            ->where('visit_date', $today)
            ->where('queue_number', $queue_number)
            ->firstOrFail();

        if ($entry->status === 'waiting' || $entry->status === 'called') {
            $entry->status = 'cancelled';
            $entry->save();

            return redirect()->route('queue.register.form')
                ->with('success', 'Your queue entry has been cancelled. You can register again if needed.');
        }

        return redirect()->route('queue.status', $queue_number)
            ->with('error', 'Cannot cancel this queue entry.');
    }
}
