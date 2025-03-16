@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Admin Dashboard</h2>

    <!-- Current Queue Status -->
    <div class="mt-4">
        <h4>Current Queue Status:</h4>
        <p>Current Queue Number: <strong>{{ $queueNumber ?? 'N/A' }}</strong></p>
    </div>

    <!-- Call Next Queue Button -->
    <form action="{{ route('queue.callNext') }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-success">Call Next Queue</button>
    </form>

    <!-- List of Pending Queues -->
    <div class="mt-4">
        <h4>Pending Queues:</h4>
        @if($pendingQueues->count() > 0)
            <ul class="list-group">
                @foreach($pendingQueues as $queue)
                    <li class="list-group-item">
                        Queue Number: <strong>{{ $queue->queue_number }}</strong>
                    </li>
                @endforeach
            </ul>
        @else
            <p>No pending queues available.</p>
        @endif
    </div>
</div>
@endsection
