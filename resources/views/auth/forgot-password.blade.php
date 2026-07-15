<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password - AdminPanel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="https://cdn-icons-png.flaticon.com/512/1534/1534938.png" type="image/png">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            min-height: 100vh;
            background: #f0f2f5;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', sans-serif;
        }
        .auth-card {
            display: flex;
            width: 900px;
            min-height: 450px;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(0,0,0,0.15);
        }
        .auth-left {
            width: 40%;
            background: linear-gradient(135deg, #f093fb, #f5576c);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 40px;
            color: #fff;
            text-align: center;
        }
        .auth-left h2 { font-size: 28px; font-weight: bold; margin-bottom: 15px; }
        .auth-left p { font-size: 14px; opacity: 0.9; margin-bottom: 30px; }
        .auth-left a {
            border: 2px solid #fff;
            color: #fff;
            padding: 10px 35px;
            border-radius: 25px;
            text-decoration: none;
            font-weight: bold;
            transition: all 0.3s;
        }
        .auth-left a:hover { background: #fff; color: #f5576c; }
        .auth-right {
            width: 60%;
            background: #fff;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 50px 40px;
        }
        .auth-right h2 {
            font-size: 26px;
            font-weight: bold;
            color: #1e2a3a;
            margin-bottom: 10px;
        }
        .auth-right p {
            font-size: 13px;
            color: #a0aec0;
            margin-bottom: 25px;
            text-align: center;
        }
        .form-control {
            border: none;
            border-bottom: 2px solid #e2e8f0;
            border-radius: 0;
            padding: 10px 15px 10px 40px;
            font-size: 14px;
            transition: all 0.3s;
        }
        .form-control:focus {
            box-shadow: none;
            border-bottom-color: #f5576c;
        }
        .input-group-icon {
            position: relative;
            margin-bottom: 20px;
        }
        .input-group-icon i {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #a0aec0;
            z-index: 10;
        }
        .btn-auth {
            background: linear-gradient(135deg, #f093fb, #f5576c);
            color: #fff;
            border: none;
            padding: 12px 50px;
            border-radius: 25px;
            font-weight: bold;
            font-size: 14px;
            letter-spacing: 1px;
            transition: all 0.3s;
            width: 100%;
        }
        .btn-auth:hover { opacity: 0.9; color: #fff; }
        .brand-icon {
            width: 70px;
            height: 70px;
            background: rgba(255,255,255,0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
            font-size: 28px;
        }
    </style>
</head>
<body>
<div class="auth-card">
    <!-- Left Side -->
    <div class="auth-left">
        <div class="brand-icon">
            <i class="fas fa-key"></i>
        </div>
        <h2>Forgot Password?</h2>
        <p>No worries! Enter your email and we'll send you reset instructions</p>
        <a href="{{ route('login') }}">SIGN IN</a>
    </div>

    <!-- Right Side -->
    <div class="auth-right">
        <h2>Reset Password</h2>
        <p>Enter your email address and we will send you a link to reset your password.</p>

        @if(session('status'))
            <div class="alert alert-success w-100 small">{{ session('status') }}</div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger w-100 small">
                @foreach($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}" style="width:100%">
            @csrf
            <div class="input-group-icon">
                <i class="fas fa-envelope"></i>
                <input type="email" name="email" class="form-control"
                    placeholder="Email Address" value="{{ old('email') }}" required>
            </div>
            <button type="submit" class="btn btn-auth">SEND RESET LINK</button>
            <div class="text-center mt-3">
                <a href="{{ route('login') }}" class="small text-muted">
                    <i class="fas fa-arrow-left me-1"></i> Back to Login
                </a>
            </div>
        </form>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>