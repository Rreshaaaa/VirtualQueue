@extends('layouts.app')

@section('content')
<div class="container vh-80 d-flex align-items-center justify-content-center">
    <div class="row w-100">
        <!-- Left Side: Student Queue Card -->
        <div class="col-md-8 d-flex justify-content-center">
            <div class="card p-4 shadow-lg text-center w-100" style="max-width: 600px; background: linear-gradient(to right, #f0f8ff, #e0f7fa); border-radius: 15px;">

                <!-- Current Queue Display -->
                <div class="bg-light rounded p-3 mb-3">
                    <h5 class="text-muted mb-1">Current Queue Number</h5>
                    <h1 class="display-1 fw-bold text-primary" id="current-queue-number">
                        {{ $currentQueue ?? '---' }}
                    </h1>
                </div>

                <!-- My Queue -->
                <div class="my-4">
                    <h5 class="fw-bold text-secondary">My Queue Number</h5>
                    <h2 class="text-success">{{ $queueNumber ?? '---' }}</h2>
                </div>

                <!-- Estimated Time -->
                <p class="text-muted mb-0">Estimated Time:</p>
                <h5 class="text-dark mb-3">00:00</h5>

                <!-- Join or Cancel Button -->
                @if ($isQueueActive)
                    <form action="{{ route('queue.cancel') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-danger w-100 py-2 fw-bold">
                            CANCEL QUEUE
                        </button>
                    </form>
                @else
                    <form action="{{ route('queue.join') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-success w-100 py-2 fw-bold">
                            JOIN QUEUE
                        </button>
                    </form>
                @endif
            </div>
        </div>

        <!-- Right Side: Upcoming Queues -->
        <div class="col-md-4">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-primary text-white text-center">
                    <strong>Upcoming Queues</strong>
                </div>
                <div class="card-body overflow-auto" style="max-height: 80vh;">
                    @if($pendingQueues->isEmpty())
                        <p class="text-muted text-center">No pending queues.</p>
                    @else
                        <ul class="list-group">
                            @foreach($pendingQueues as $queue)
                                <li class="list-group-item d-flex justify-content-between align-items-center
                                    {{ $queue->queue_number == $queueNumber ? 'bg-info text-white fw-bold' : '' }}">
                                    {{ $queue->queue_number }}
                                    <span class="badge bg-secondary">{{ ucfirst($queue->status) }}</span>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Announcement Voice Script -->
@if(!empty($currentQueue))
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const queueNumber = '{{ $currentQueue }}';
        const message = `Calling Queue number {{ $currentQueue }}, please proceed to Window 1.`;
        const beep = new Audio('{{ asset('sounds/beep.mp3') }}');
        let repeatCount = 0;
        const maxRepeats = 3;

        // Delay 10 seconds after page load
        setTimeout(() => {
            function announce() {
                if (repeatCount < maxRepeats) {
                    beep.play();

                    // Speak after 1.5s delay to allow beep
                    setTimeout(() => {
                        const utterance = new SpeechSynthesisUtterance(message);
                        utterance.lang = 'en-US';
                        utterance.rate = 1;
                        utterance.pitch = 1;

                        utterance.onend = function () {
                            repeatCount++;
                            setTimeout(announce, 1000); // 1s gap between repeats
                        };

                        window.speechSynthesis.speak(utterance);
                    }, 1500);
                }
            }

            announce();
        }, 5000); // 10 seconds delay after load
    });
</script>
@endif


<!-- Auto Refresh Script -->
<script>
    setInterval(function () {
        window.location.reload();
    }, 20000); // refresh every 10 seconds
</script>




@endsection
