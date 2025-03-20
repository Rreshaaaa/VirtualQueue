<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Laravel') }}
        </a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ml-auto">
                {{-- Student Logout --}}
                @if(Auth::guard('student')->check())
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('student.queue') }}">Queue Page</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('student.logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-form-student').submit();">
                            Logout
                        </a>
                        <form id="logout-form-student" action="{{ route('student.logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                @endif

                {{-- Admin Logout --}}
                @if(Auth::guard('admin')->check())
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.dashboard') }}">Admin Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-form-admin').submit();">
                            Logout
                        </a>
                        <form id="logout-form-admin" action="{{ route('admin.logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                @endif
            </ul>

        </div>
    </nav>

    <div class="container mt-4">
        @yield('content')
    </div>
</body>
</html>
