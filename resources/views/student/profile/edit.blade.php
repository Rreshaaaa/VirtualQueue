@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Edit Profile</h2>

    <form action="{{ route('student.profile.update') }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>First Name</label>
            <input type="text" name="first_name" class="form-control" value="{{ old('first_name', $student->first_name) }}" required>
        </div>

        <div class="mb-3">
            <label>Middle Name</label>
            <input type="text" name="middle_name" class="form-control" value="{{ old('middle_name', $student->middle_name) }}">
        </div>

        <div class="mb-3">
            <label>Last Name</label>
            <input type="text" name="last_name" class="form-control" value="{{ old('last_name', $student->last_name) }}" required>
        </div>

        <div class="mb-3">
            <label>Contact Number</label>
            <input type="text" name="contact_number" class="form-control" value="{{ old('contact_number', $student->contact_number) }}">
        </div>

        <div class="mb-3">
            <label>Address</label>
            <textarea name="address" class="form-control">{{ old('address', $student->address) }}</textarea>
        </div>

        <div class="mb-3">
            <label>About You</label>
            <textarea name="about" id="about" class="form-control" rows="4" placeholder="Tell us something about you...">{{ old('about', $student->about) }}</textarea>
        </div>

        <button type="submit" class="btn btn-success">Save Changes</button>
        <a href="{{ route('student.profile.show') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
