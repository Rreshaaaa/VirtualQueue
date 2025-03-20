@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Admin ogin</h2>
    @if ($errors->any())
        <div class="alert alert-danger">
            {{ $errors->first('email') }}
        </div>
    @endif
    <form method="POST" action="{{ route('admin.login') }}">
        @csrf
        <div class="mb-3">
            <label for="email">Email address</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="password">Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
    </form>
</div>
@endsection
