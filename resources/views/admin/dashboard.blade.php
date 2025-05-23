@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center align-items-center vh-90">
    <div class="card p-4 shadow-lg" style="width: 800px; background: linear-gradient(to right, #ffffff, #c2e0ff); border-radius: 10px;">

        <!-- Current Queue Number -->
        <div class="d-flex align-items-center">
            <div class="text-center p-3 bg-light shadow-sm" style="border-radius: 10px; flex: 1;">
                <h5 class="text-muted">Current Queue Number</h5>
                <h2 class="font-weight-bold">{{ $queueNumber ?? '---' }}</h2>
            </div>

            <div class="ml-3 d-flex flex-column">
                <form action="{{ route('queue.markDone') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-success btn-lg mb-2" style="width: 120px;">DONE</button>
                </form>

                <form action="{{ route('queue.callNext') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-secondary btn-lg" style="width: 120px;">CALL</button>
                </form>
            </div>
        </div>

        <!-- Waiting List Table -->
        <div class="mt-4">
            <h5 class="text-center font-weight-bold">Waiting List</h5>
            <div class="table-responsive">
                <table class="table table-bordered text-center shadow-sm" style="background-color: white;">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th>Queue No.</th>
                            <th>Service Name</th>
                            <th>Issue Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pendingQueues as $queue)
                        <tr>
                            <td><strong>{{ $queue->queue_number }}</strong></td>
                            <td>ENROLLMENT</td>
                            <td>00:00</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-between align-items-center mt-3">
            <p class="m-0 text-muted">Total Entries: {{ $pendingQueues->count() }}</p>
            <nav>
                <!-- Laravel pagination -->
            </nav>
        </div>

    </div>
</div>

{{-- @if(session('calledQueue'))
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const queueNumber = '{{ session('calledQueue') }}';
        const message = ` Calling Queue number {{ session('calledQueue') }}, please proceed to Window 1.`;
        const repeatCount = 5;
        let count = 0;

        // Load beep sound
        const beep = new Audio('{{ asset('sounds/beep.mp3') }}');

        function speakQueue() {
            if (count < repeatCount) {
                // Play beep first
                beep.play();

                // Wait until beep finishes (~500ms) then speak
                setTimeout(() => {
                    const utterance = new SpeechSynthesisUtterance(message);
                    utterance.lang = 'en-US';
                    utterance.rate = 1;
                    utterance.pitch = 1;

                    utterance.onend = function () {
                        count++;
                        setTimeout(speakQueue, 1000); // 1 sec between repeats
                    };

                    window.speechSynthesis.speak(utterance);
                }, 1500); // Delay to allow beep to play
            }
        }

        speakQueue();
    });
</script>
@endif --}}

<script>
    // Auto-refresh the entire page every 10 seconds
    setInterval(function () {
        window.location.reload();
    }, 40000); // 10,000 milliseconds = 10 seconds
</script>
@endsection

