<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Queue | Welcome</title>

    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    <style>
        body {
            height: 90vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(to right, #ffffff, #87CEFA);
            font-family: 'Poppins', sans-serif;
        }
        .container {
            text-align: center;
        }
        .logo {
            width: 320px;
            margin-bottom: 20px;
        }
        .btn-custom {
            font-family: 'Poppins', sans-serif;
            width: 200px;
            padding: 12px;
            font-size: 18px;
            border-radius: 8px;
            font-weight: bold;
        }
        .btn-signin {
            background-color: #5D9CEC;
            color: white;
            border: none;
        }
        .btn-signup {
            background-color: #007BFF;
            color: white;
            border: none;
        }
        .btn-signin:hover {
            background-color: #4a8cd8;
        }
        .btn-signup:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<div class="container">
    <img src="{{ asset('assets/images/e-queuelogo.png') }}" alt="E-Queue Logo" class="logo">
    <h3>Welcome to E-Queue</h3>

    <div class="mt-4">
        <a href="{{ route('student.login') }}" class="btn btn-custom btn-signin me-2">Sign In</a>
        <a href="{{ route('student.register') }}" class="btn btn-custom btn-signup">Sign Up</a>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js" defer></script>
</body>
</html>
