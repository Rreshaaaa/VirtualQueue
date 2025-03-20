<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Queue;

class QueueController extends Controller
{
    // Student queue page method
    public function queuePage()
    {
        $studentQueue = auth()->guard('student')->user()->queue()->latest('id')->first();

        $queueNumber = $studentQueue ? $studentQueue->queue_number : 'N/A';
        $isQueueActive = $studentQueue && $studentQueue->status === 'pending';

        $currentQueue = Queue::where('status', 'done')->latest('id')->first();

        return view('student.queue', [
            'queueNumber' => $queueNumber,
            'currentQueue' => $currentQueue ? $currentQueue->queue_number : 'N/A',
            'isQueueActive' => $isQueueActive
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
        $student = auth()->guard('student')->user();

        if ($student->queue()->where('status', 'pending')->exists()) {
            return back()->with('error', 'You already have an active queue number.');
        }

        $lastQueue = Queue::latest('id')->first();
        $newQueueNumber = $lastQueue
            ? 'Q' . str_pad((intval(substr($lastQueue->queue_number, 1)) + 1), 3, '0', STR_PAD_LEFT)
            : 'Q001';

        $queue = new Queue();
        $queue->student_id = $student->id;
        $queue->queue_number = $newQueueNumber;
        $queue->status = 'pending';
        $queue->save();

        return back()->with('success', 'You have joined the queue.');
    }

    // Call next queue method
    public function callNext()
    {
        $currentQueue = Queue::where('status', 'active')->first();
        if ($currentQueue) {
            $currentQueue->status = 'done';
            $currentQueue->save();
        }

        $nextQueue = Queue::where('status', 'pending')->orderBy('id')->first();

        if ($nextQueue) {
            $nextQueue->status = 'active';
            $nextQueue->save();

            return redirect()->route('admin.dashboard')->with('success', 'Now calling ' . $nextQueue->queue_number);
        }

        return redirect()->route('admin.dashboard')->with('error', 'No queue available.');
    }

    // Cancel queue method
    public function cancelQueue()
    {
        $student = auth()->guard('student')->user();

        $student->queue()->where('status', 'pending')->delete();

        return back()->with('success', 'Your queue number has been canceled.');
    }
}
