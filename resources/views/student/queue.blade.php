@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Student Dashboard</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if($isQueueActive)
        <div class="mt-4">
            <h4>Current Queue Status:</h4>
            <p>Current Number: <strong>{{ $currentQueue ?? 'N/A' }}</strong></p>
            <p>Your Queue Number: <strong>{{ $queueNumber }}</strong></p>
            <form action="{{ route('queue.cancel') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-danger">Cancel Queue</button>
            </form>
        </div>
    @else
        <form action="{{ route('queue.join') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-primary">Join Queue</button>
        </form>
    @endif
</div>
@endsection
