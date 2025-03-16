<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel Auth</title>

    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js" defer></script>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">My App</a>
        <div class="d-flex">
            @guest
                <a class="btn btn-outline-light me-2" href="{{ url('/login') }}">Login</a>
                <a class="btn btn-primary" href="{{ url('/register') }}">Register</a>
            @else
                <a class="btn btn-outline-light me-2" href="{{ url('/dashboard') }}">Dashboard</a>
                <form method="POST" action="{{ route('logout') }}" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-danger">Logout</button>
                </form>
            @endguest
        </div>
    </div>
</nav>

<!-- Content -->
<div class="container mt-5">
    <h1>Welcome to Laravel</h1>
    <p>This is a sample authentication setup for student and admin accounts.</p>
</div>

</body>
</html>
