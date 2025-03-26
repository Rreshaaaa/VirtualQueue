<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, #ffffff, #64a6ff);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .register-container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            width: 500px;
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
    <div class="register-container">
        <h2>Sign Up</h2>
        <form method="POST" action="{{ url('/register') }}">
            @csrf
            <div class="row">
                <div class="col-md-4 mb-2">
                    <input type="text" class="form-control" name="first_name" placeholder="First Name" required>
                </div>
                <div class="col-md-4 mb-2">
                    <input type="text" class="form-control" name="middle_name" placeholder="Middle Name">
                </div>
                <div class="col-md-4 mb-2">
                    <input type="text" class="form-control" name="last_name" placeholder="Last Name" required>
                </div>
            </div>
            <input type="email" class="form-control mb-2" name="email" placeholder="Email" required>
            <div class="row">
                <div class="col-md-6 mb-2">
                    <input type="password" class="form-control" name="password" placeholder="Password" required>
                </div>
                <div class="col-md-6 mb-2">
                    <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" required>
                </div>
            </div>
            <button type="submit" class="btn btn-submit">SUBMIT</button>
            <p class="mt-2">Already have an account? <a href="{{ url('/login') }}">Sign In</a></p>
        </form>
    </div>
</body>
</html>
