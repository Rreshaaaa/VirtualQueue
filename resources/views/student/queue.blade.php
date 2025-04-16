@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="fw-bold">Queue Page</h2>
    <p class="text-muted">Student Number: {{ Auth::user()->student_number ?? 'N/A' }}</p>

    <div class="row mt-3">
        <!-- Left Section: Queue List -->
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white d-flex justify-content-between">
                    <span>Upcoming</span>
                    <span>Service</span>
                    <span>Done</span>
                </div>
                <div class="card-body" style="max-height: 400px; overflow-y: auto;">
                    @foreach ($pendingQueues as $queue)
                        <div class="d-flex justify-content-between border-bottom py-2">
                            <div>{{ $queue->queue_number }}</div>
                            <div>ENROLLMENT</div>
                            <div>00:00</div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Right Section: Queue Info Panel -->
        <div class="col-md-4">
            <div class="card text-center p-4">
                <h5 class="fw-bold">MY QUEUE NUMBER</h5>
                <h1 class="fw-bold my-3">
                    {{ $queueNumber ?? '---' }}
                </h1>
                <p class="mb-1">Estimated Time:</p>
                <h5>00:00</h5>

                @if ($isQueueActive)
    <!-- If queue is active, show cancel button -->
    <form action="{{ route('queue.cancel') }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-danger w-100 mt-3 py-2 fw-bold">
            CANCEL QUEUE
        </button>
    </form>
@else
    <!-- If no active queue, show join button -->
    <form action="{{ route('queue.join') }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-success w-100 mt-3 py-2 fw-bold">
            JOIN QUEUE
        </button>
    </form>
@endif

            </div>
        </div>
    </div>
</div>
@endsection
