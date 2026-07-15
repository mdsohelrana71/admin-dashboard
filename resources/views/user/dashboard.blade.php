<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { background: #f0f2f5; font-family: 'Segoe UI', sans-serif; }
        .topbar {
            background: linear-gradient(135deg, #667eea, #764ba2);
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: #fff;
        }
        .topbar .brand { font-size: 20px; font-weight: bold; }
        .topbar .user-info { display: flex; align-items: center; gap: 10px; }
        .avatar {
            width: 40px; height: 40px;
            background: rgba(255,255,255,0.3);
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-weight: bold; font-size: 16px;
        }
        .welcome-banner {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: #fff;
            padding: 40px 30px;
            margin-bottom: 30px;
        }
        .welcome-banner h2 { font-size: 28px; font-weight: bold; }
        .welcome-banner p { opacity: 0.85; margin-top: 5px; }
        .stat-card {
            border-radius: 15px;
            padding: 25px;
            color: #fff;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 20px;
        }
        .stat-card .icon {
            width: 60px; height: 60px;
            background: rgba(255,255,255,0.2);
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-size: 24px;
        }
        .info-card {
            background: #fff;
            border-radius: 15px;
            padding: 25px;
            margin-bottom: 20px;
            box-shadow: 0 2px 15px rgba(0,0,0,0.05);
        }
        .info-card h5 {
            font-weight: bold;
            color: #1e2a3a;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #f0f2f5;
        }
        .btn-logout {
            background: rgba(255,255,255,0.2);
            border: 2px solid rgba(255,255,255,0.5);
            color: #fff;
            padding: 8px 20px;
            border-radius: 25px;
            text-decoration: none;
            font-size: 14px;
            transition: all 0.3s;
        }
        .btn-logout:hover { background: #fff; color: #667eea; }
        #live-clock {
            font-size: 32px;
            font-weight: bold;
            color: #667eea;
        }
        #live-date {
            color: #a0aec0;
            font-size: 14px;
        }
    </style>
</head>
<body>

{{-- Topbar --}}
<div class="topbar">
    <div class="brand">
        <i class="fas fa-tachometer-alt me-2"></i> UserPanel
    </div>
    <div class="user-info">
        @if(auth()->user()->profile_photo)
            <img src="{{ asset('uploads/profiles/' . auth()->user()->profile_photo) }}"
                 style="width:40px;height:40px;border-radius:50%;object-fit:cover;">
        @else
            <div class="avatar">
                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
            </div>
        @endif
        <span id="topbar-name">{{ auth()->user()->name }}</span>
        <form method="POST" action="{{ route('logout') }}" style="margin:0">
            @csrf
            <button type="submit" class="btn-logout">
                <i class="fas fa-sign-out-alt"></i> Logout
            </button>
        </form>
    </div>
</div>

{{-- Welcome Banner --}}
<div class="welcome-banner">
    <div class="container">
        <h2>Welcome back, <span id="welcome-name">{{ auth()->user()->name }}</span>! 👋</h2>
        <p id="live-date">{{ now()->format('l, d M Y') }}</p>
    </div>
</div>

{{-- Main Content --}}
<div class="container">
    <div class="row">
        {{-- Stat Cards --}}
        <div class="col-md-4">
            <div class="stat-card" style="background: linear-gradient(135deg, #667eea, #764ba2)">
                <div class="icon"><i class="fas fa-user"></i></div>
                <div>
                    <div style="font-size:13px;opacity:0.85;">Account Type</div>
                    <div style="font-size:22px;font-weight:bold;">User</div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stat-card" style="background: linear-gradient(135deg, #11998e, #38ef7d)">
                <div class="icon"><i class="fas fa-calendar"></i></div>
                <div>
                    <div style="font-size:13px;opacity:0.85;">Member Since</div>
                    <div style="font-size:22px;font-weight:bold;">{{ auth()->user()->created_at->format('M Y') }}</div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stat-card" style="background: linear-gradient(135deg, #f093fb, #f5576c)">
                <div class="icon"><i class="fas fa-clock"></i></div>
                <div>
                    <div style="font-size:13px;opacity:0.85;">Current Time</div>
                    <div id="live-clock" style="font-size:20px;font-weight:bold;color:#fff;"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        {{-- Profile Update --}}
        <div class="col-md-6">
            <div class="info-card">
                <h5><i class="fas fa-user-edit me-2 text-primary"></i> Edit Profile</h5>
                <div id="profile-alert"></div>
                <div class="mb-3">
                    <label class="form-label">Full Name</label>
                    <input type="text" id="user-name" class="form-control" value="{{ auth()->user()->name }}">
                </div>
                <div class="mb-3">
                    <label class="form-label">Email Address</label>
                    <input type="email" id="user-email" class="form-control" value="{{ auth()->user()->email }}">
                </div>
                <button class="btn btn-primary" onclick="updateProfile()">
                    <i class="fas fa-save me-2"></i> Save Changes
                </button>
            </div>
        </div>

        {{-- Password Update --}}
        <div class="col-md-6">
            <div class="info-card">
                <h5><i class="fas fa-lock me-2 text-danger"></i> Change Password</h5>
                <div id="password-alert"></div>
                <div class="mb-3" style="position:relative;">
                    <label class="form-label">Current Password</label>
                    <input type="password" id="current_password" class="form-control" style="padding-right:40px;">
                    <i class="fas fa-eye" style="position:absolute;right:12px;top:68%;transform:translateY(-50%);cursor:pointer;color:#a0aec0;" onclick="togglePass('current_password', this)"></i>
                </div>
                <div class="mb-3" style="position:relative;">
                    <label class="form-label">New Password</label>
                    <input type="password" id="new_password" class="form-control" style="padding-right:40px;">
                    <i class="fas fa-eye" style="position:absolute;right:12px;top:68%;transform:translateY(-50%);cursor:pointer;color:#a0aec0;" onclick="togglePass('new_password', this)"></i>
                </div>
                <div class="mb-3" style="position:relative;">
                    <label class="form-label">Confirm New Password</label>
                    <input type="password" id="confirm_password" class="form-control" style="padding-right:40px;">
                    <i class="fas fa-eye" style="position:absolute;right:12px;top:68%;transform:translateY(-50%);cursor:pointer;color:#a0aec0;" onclick="togglePass('confirm_password', this)"></i>
                </div>
                <button class="btn btn-danger" onclick="updatePassword()">
                    <i class="fas fa-key me-2"></i> Update Password
                </button>
            </div>
        </div>
    </div>

    {{-- Profile Info --}}
    <div class="row">
        <div class="col-md-12">
            <div class="info-card">
                <h5><i class="fas fa-info-circle me-2 text-success"></i> Account Information</h5>
                <div class="row">
                    <div class="col-md-3 text-center">
                        @if(auth()->user()->profile_photo)
                            <img src="{{ asset('uploads/profiles/' . auth()->user()->profile_photo) }}"
                                 style="width:80px;height:80px;border-radius:50%;object-fit:cover;">
                        @else
                            <div style="width:80px;height:80px;background:linear-gradient(135deg,#667eea,#764ba2);border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto;">
                                <span style="color:#fff;font-size:32px;font-weight:bold;">
                                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                </span>
                            </div>
                        @endif
                        <p class="mt-2 fw-bold" id="profile-name">{{ auth()->user()->name }}</p>
                    </div>
                    <div class="col-md-9">
                        <table class="table table-borderless">
                            <tr>
                                <td class="text-muted">Full Name</td>
                                <td><strong id="info-name">{{ auth()->user()->name }}</strong></td>
                            </tr>
                            <tr>
                                <td class="text-muted">Email</td>
                                <td><strong id="info-email">{{ auth()->user()->email }}</strong></td>
                            </tr>
                            <tr>
                                <td class="text-muted">Role</td>
                                <td><span class="badge bg-primary">User</span></td>
                            </tr>
                            <tr>
                                <td class="text-muted">Joined</td>
                                <td><strong>{{ auth()->user()->created_at->format('d M Y') }}</strong></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
// Live Clock
function updateClock() {
    const now = new Date();
    let h = now.getHours().toString().padStart(2, '0');
    let m = now.getMinutes().toString().padStart(2, '0');
    let s = now.getSeconds().toString().padStart(2, '0');
    document.getElementById('live-clock').textContent = `${h}:${m}:${s}`;
}
setInterval(updateClock, 1000);
updateClock();

// Eye Toggle
function togglePass(fieldId, icon) {
    const field = document.getElementById(fieldId);
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

// Ajax Update Profile
function updateProfile() {
    const name = document.getElementById('user-name').value;
    const email = document.getElementById('user-email').value;

    fetch('{{ route("user.update.profile") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({ name, email })
    })
    .then(res => res.json())
    .then(data => {
        const alert = document.getElementById('profile-alert');
        if (data.success) {
            alert.innerHTML = `<div class="alert alert-success">${data.message}</div>`;
            document.getElementById('welcome-name').textContent = name;
            document.getElementById('topbar-name').textContent = name;
            document.getElementById('profile-name').textContent = name;
            document.getElementById('info-name').textContent = name;
            document.getElementById('info-email').textContent = email;
        } else {
            alert.innerHTML = `<div class="alert alert-danger">${data.message}</div>`;
        }
        setTimeout(() => alert.innerHTML = '', 3000);
    });
}

// Ajax Update Password
function updatePassword() {
    const current_password = document.getElementById('current_password').value;
    const password = document.getElementById('new_password').value;
    const password_confirmation = document.getElementById('confirm_password').value;

    fetch('{{ route("user.update.password") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({ current_password, password, password_confirmation })
    })
    .then(res => res.json())
    .then(data => {
        const alert = document.getElementById('password-alert');
        if (data.success) {
            alert.innerHTML = `<div class="alert alert-success">${data.message}</div>`;
            document.getElementById('current_password').value = '';
            document.getElementById('new_password').value = '';
            document.getElementById('confirm_password').value = '';
        } else {
            alert.innerHTML = `<div class="alert alert-danger">${data.message}</div>`;
        }
        setTimeout(() => alert.innerHTML = '', 3000);
    });
}
</script>
</body>
</html>