<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Queue;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class QueueController extends Controller
{
    // Student queue page method
    public function queuePage()
{
    $studentQueue = auth()->guard('student')->user()
        ->queue()
        ->whereIn('status', ['pending', 'active'])
        ->latest('id')
        ->first();

    $queueNumber = $studentQueue ? $studentQueue->queue_number : null;
    $isQueueActive = $studentQueue !== null;

    $pendingQueues = Queue::where('status', 'pending')->get();
    $currentQueue = Queue::where('status', 'active')->first();

    // Pull calledQueue from session if available
    $calledQueue = session('calledQueue');

    return view('student.queue', [
        'queueNumber' => $queueNumber,
        'currentQueue' => $currentQueue ? $currentQueue->queue_number : null,
        'pendingQueues' => $pendingQueues,
        'isQueueActive' => $isQueueActive,
        'calledQueue' => $calledQueue // pass it here
    ]);
}



    // Admin dashboard method
    public function adminDashboard()
    {
        $currentQueue = Queue::where('status', 'active')->first();
        $pendingQueues = Queue::where('status', 'pending')->get();

        return view('admin.dashboard', [
            'queueNumber' => $currentQueue ? $currentQueue->queue_number : null,
            'pendingQueues' => $pendingQueues
        ]);
    }

    // Join queue method
    public function joinQueue(Request $request)
{
    $student = Auth::guard('student')->user();

    // Check if the student already has a pending queue
    $existingQueue = $student->queue()->where('status', 'pending')->latest()->first();

    if (!$existingQueue) {
        do {
            // Generate a unique queue number
            $queueNumber = 'Q' . str_pad(mt_rand(1, 999), 3, '0', STR_PAD_LEFT);
        } while (Queue::where('queue_number', $queueNumber)->exists()); // Ensure it's unique

        // Create a new queue entry
        $queue = $student->queue()->create([
            'queue_number' => $queueNumber,
            'status' => 'pending',
        ]);
    }

    return redirect()->route('student.queue')->with('success', 'You have joined the queue.');
}
        public function markDone()
        {
            $currentQueue = Queue::where('status', 'active')->first();

            if ($currentQueue) {
                $currentQueue->update(['status' => 'done']);
                return redirect()->route('admin.dashboard')->with('success', 'Queue ' . $currentQueue->queue_number . ' marked as done.');
            }

            return redirect()->route('admin.dashboard')->with('error', 'No active queue to mark as done.');
        }



    // Call next queue method
    public function callNext()
{
    DB::transaction(function () {
        // Mark the current active queue as done
        $currentQueue = Queue::where('status', 'active')->first();
        if ($currentQueue) {
            $currentQueue->update(['status' => 'done']);
        }

        // Get the next pending queue
        $nextQueue = Queue::where('status', 'pending')->orderBy('id')->first();

        if ($nextQueue) {
            $nextQueue->update(['status' => 'active']);

            // Flash both success message and queue number for voice
            session()->flash('success', 'Now calling ' . $nextQueue->queue_number);
            session()->flash('calledQueue', $nextQueue->queue_number); // 👈 This enables voice
        } else {
            session()->flash('error', 'No queue available.');
        }
    });

    return redirect()->route('admin.dashboard');
}


    // Cancel queue method
    public function cancelQueue(Request $request)
{
    $user = Auth::user(); // Ensure the user is authenticated

    // Fetch the user's queue entry
    $queue = $user->queue()->where('status', 'pending')->latest()->first();

    if ($queue) {
        $queue->update(['status' => 'cancelled']); // Update the queue status
        return redirect()->back()->with('success', 'Queue canceled successfully.');
    }

    Log::warning('No active queue found for user', ['user_id' => Auth::id()]);
    return redirect()->back()->with('error', 'No active queue found.');
}


}
