@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card p-4 shadow-sm">
        <div class="row">
            <!-- Profile Picture -->
            <div class="col-md-2 text-center">
                <img src="{{ $student->photo ? asset('storage/students/' . $student->photo) : asset('assets/images/profileicon.png') }}"
                alt="Profile Photo"
                class="rounded-circle"
                width="100"
                height="100">
            </div>

            <!-- Basic Info -->
            <div class="col-md-7">
                <h4 class="fw-bold">{{ $student->first_name }} {{ $student->middle_name }} {{ $student->last_name }}</h4>
                <p class="text-muted">( {{ Auth::user()->student_number ?? 'N/A' }} )</p>
                <p class="text-muted mb-2">Student</p>
                <hr>
                {{-- <h6 class="fw-bold">About You</h6>
                <p>{{ $student->about ?? 'No information provided yet.' }}</p> --}}
            </div>

            <!-- Contact Box -->
            <div class="col-md-3">
                <div class="border rounded p-3 shadow-sm bg-light">
                    <p class="mb-1"><strong>Phone:</strong><br> {{ $student->contact_number ?? 'Not Provided' }}</p>
                    <p class="mb-1"><strong>Email:</strong><br> {{ $student->email }}</p>
                    <p class="mb-1"><strong>Address:</strong><br> {{ $student->address }}</p>
                    <p class="mb-1"><strong>Campus:</strong><br> System Plus Computer College</p>
                </div>
            </div>
        </div>

        <div class="text-end mt-3">
            <a href="{{ route('student.profile.edit') }}" class="btn btn-primary">Edit Profile</a>
        </div>
    </div>
</div>
@endsection
