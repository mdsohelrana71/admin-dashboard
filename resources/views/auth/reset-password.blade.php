<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - AdminPanel</title>
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
            min-height: 500px;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(0,0,0,0.15);
        }
        .auth-left {
            width: 40%;
            background: linear-gradient(135deg, #4e54c8, #8f94fb);
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
        .auth-left a:hover { background: #fff; color: #4e54c8; }
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
            border-bottom-color: #4e54c8;
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
            background: linear-gradient(135deg, #4e54c8, #8f94fb);
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
            <i class="fas fa-shield-alt"></i>
        </div>
        <h2>New Password</h2>
        <p>Create a strong password to keep your account secure</p>
        <a href="{{ route('login') }}">SIGN IN</a>
    </div>

    <!-- Right Side -->
    <div class="auth-right">
        <h2>Reset Password</h2>
        <p>Enter your new password below to reset your account password.</p>

        @if($errors->any())
            <div class="alert alert-danger w-100 small">
                @foreach($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('password.store') }}" style="width:100%">
            @csrf
            <input type="hidden" name="token" value="{{ $request->route('token') }}">
            <div class="input-group-icon">
                <i class="fas fa-envelope"></i>
                <input type="email" name="email" class="form-control"
                    placeholder="Email Address" value="{{ old('email', $request->email) }}" required>
            </div>
            <div class="input-group-icon" style="position:relative;">
                <i class="fas fa-lock"></i>
                <input type="password" name="password" id="reset_password" class="form-control"
                    placeholder="New Password" style="padding-right:40px;" required>
                <i class="fas fa-eye" id="toggleResetPassword"
                    style="position:absolute;left:95%;top:50%;transform:translateY(-50%);cursor:pointer;color:#a0aec0;z-index:10;"
                    onclick="togglePass('reset_password','toggleResetPassword')"></i>
            </div>

            <div class="input-group-icon" style="position:relative;">
                <i class="fas fa-lock"></i>
                <input type="password" name="password_confirmation" id="reset_confirm" class="form-control"
                    placeholder="Confirm New Password" style="padding-right:40px;" required>
                <i class="fas fa-eye" id="toggleResetConfirm"
                    style="position:absolute;left:95%;top:50%;transform:translateY(-50%);cursor:pointer;color:#a0aec0;z-index:10;"
                    onclick="togglePass('reset_confirm','toggleResetConfirm')"></i>
            </div>
            <button type="submit" class="btn btn-auth">RESET PASSWORD</button>
            <div class="text-center mt-3">
                <a href="{{ route('login') }}" class="small text-muted">
                    <i class="fas fa-arrow-left me-1"></i> Back to Login
                </a>
            </div>
        </form>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
function togglePass(fieldId, iconId) {
    const field = document.getElementById(fieldId);
    const icon = document.getElementById(iconId);
    if (field.type === 'password') {
        field.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    } else {
        field.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    }
}
</script>
</body>
</html>