<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Queue;

class QueueController extends Controller
{
    public function studentDashboard()
    {
        $userQueue = auth()->user()->queue()->latest('id')->first();

    $queueNumber = $userQueue ? $userQueue->queue_number : 'N/A';
    $isQueueActive = $userQueue && $userQueue->status === 'pending';

    $currentQueue = Queue::where('status', 'done')->latest('id')->first();

    return view('student.dashboard', [
        'queueNumber' => $queueNumber,
        'currentQueue' => $currentQueue ? $currentQueue->queue_number : 'N/A',
        'isQueueActive' => $isQueueActive
    ]);
    }

    public function adminDashboard()
    {
        $currentQueue = Queue::where('status', 'active')->first();
        $pendingQueues = Queue::where('status', 'pending')->orderBy('id')->get();

        return view('admin.dashboard', [
            'queueNumber' => $currentQueue ? $currentQueue->queue_number : 'N/A',
            'pendingQueues' => $pendingQueues
        ]);
    }

    public function joinQueue(Request $request)
    {
        $user = auth()->user();

    // Check if the user already has an active queue
    if ($user->queue()->where('status', 'pending')->exists()) {
        return back()->with('error', 'You already have an active queue number.');
    }

    // Generate a new queue number
    $lastQueue = Queue::latest('id')->first();
    $newQueueNumber = $lastQueue ? 'Q' . str_pad((intval(substr($lastQueue->queue_number, 1)) + 1), 3, '0', STR_PAD_LEFT) : 'Q001';

    $queue = new Queue();
    $queue->user_id = $user->id;
    $queue->queue_number = $newQueueNumber;
    $queue->status = 'pending';
    $queue->save();

    return back()->with('success', 'You have joined the queue.');
    }

    public function callNext()
    {
        // First, mark the current active queue as 'done'
    $currentQueue = Queue::where('status', 'active')->first();
    if ($currentQueue) {
        $currentQueue->status = 'done';
        $currentQueue->save();
    }

    // Then, select the next available pending queue and mark it as 'active'
    $nextQueue = Queue::where('status', 'pending')->orderBy('id')->first();

    if ($nextQueue) {
        $nextQueue->status = 'active';
        $nextQueue->save();

        return redirect()->route('admin.dashboard')->with('success', 'Now calling ' . $nextQueue->queue_number);
    }

    return redirect()->route('admin.dashboard')->with('error', 'No queue available.');
    }
    public function cancelQueue()
    {
        $user = auth()->user();

    // Remove the user's queue entry
    $user->queue()->where('status', 'pending')->delete();

    return back()->with('success', 'Your queue number has been canceled.');
    }
}
