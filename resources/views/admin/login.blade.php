<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, #ffffff, #64a6ff);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .login-container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            width: 400px;
            text-align: center;
        }
        .btn-submit {
            background-color: #007bff;
            color: white;
            font-weight: bold;
            width: 100%;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Admin Login</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('admin.login') }}">
            @csrf
            <input type="email" class="form-control mb-3" name="email" placeholder="Email" required>
            <input type="password" class="form-control mb-3" name="password" placeholder="Password" required>
            <div class="d-flex justify-content-between mb-3">
                <div>
                    <input type="checkbox" id="remember" name="remember">
                    <label for="remember">Remember Me</label>
                </div>
                <a href="#">Forgot Password?</a>
            </div>
            <button type="submit" class="btn btn-submit">LOGIN</button>
            <p class="mt-2">Not a student? <a href="{{ url('/') }}">Back to Home</a></p>
        </form>
    </div>
</body>
</html>
