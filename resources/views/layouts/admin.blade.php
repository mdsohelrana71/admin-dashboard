<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="https://cdn-icons-png.flaticon.com/512/1534/1534938.png" type="image/png">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: #f0f2f5;
            font-family: 'Segoe UI', sans-serif;
        }

        .sidebar {
            width: 260px;
            min-height: 100vh;
            background: #1e2a3a;
            position: fixed;
            top: 0;
            left: 0;
            overflow-y: auto;
            z-index: 100;
        }

        .sidebar .brand {
            padding: 22px 20px;
            color: #fff;
            font-size: 20px;
            font-weight: bold;
            border-bottom: 1px solid #2d3f54;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .sidebar .section-title {
            padding: 15px 20px 5px;
            color: #607d8b;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .sidebar a {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 11px 20px;
            color: #a0aec0;
            text-decoration: none;
            font-size: 14px;
            transition: all 0.2s;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background: #2d3f54;
            color: #fff;
            border-left: 3px solid #4e9af1;
        }

        .sidebar a i {
            width: 18px;
            text-align: center;
        }

        .sidebar .divider {
            border-top: 1px solid #2d3f54;
            margin: 8px 0;
        }

        .main-content {
            margin-left: 260px;
        }

        .topbar {
            background: #fff;
            padding: 14px 25px;
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 99;
        }

        .stat-card {
            border-radius: 12px;
            padding: 22px;
            color: #fff;
            margin-bottom: 20px;
        }

        .stat-card h6 {
            opacity: 0.85;
            font-size: 13px;
        }

        .stat-card h2 {
            font-size: 36px;
            font-weight: bold;
        }

        .stat-icon {
            font-size: 40px;
            opacity: 0.3;
            float: right;
            margin-top: -10px;
        }
    </style>
</head>

<body>
    <div class="sidebar">
        <div class="brand">
            <i class="fas fa-tachometer-alt" style="color:#4e9af1"></i>
            AdminPanel
        </div>

        <div class="section-title">Main</div>
        <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <i class="fas fa-home"></i> Dashboard
        </a>

        <div class="divider"></div>
        <div class="section-title">Product Management</div>
        <a href="{{ route('admin.product-brands.index') }}" class="{{ request()->routeIs('admin.product-brands.index') ? 'active' : '' }}">
            <i class="fas fa-tags"></i> Brands
        </a>

        <div class="divider"></div>
        <div class="section-title">User Management</div>
        <a href="{{ route('admin.users') }}" class="{{ request()->routeIs('admin.users') ? 'active' : '' }}">
            <i class="fas fa-users"></i> All Users
        </a>
        <a href="{{ route('admin.users.create') }}" class="{{ request()->routeIs('admin.users.create') ? 'active' : '' }}">
            <i class="fas fa-user-plus"></i> Add User
        </a>
        <a href="{{ route('admin.admins') }}" class="{{ request()->routeIs('admin.admins') ? 'active' : '' }}">
            <i class="fas fa-user-shield"></i> Admins
        </a>

        <div class="divider"></div>
        <div class="section-title">Reports</div>
        <a href="{{ route('admin.statistics') }}" class="{{ request()->routeIs('admin.statistics') ? 'active' : '' }}">
            <i class="fas fa-chart-bar"></i> Statistics
        </a>
        <a href="{{ route('admin.charts') }}" class="{{ request()->routeIs('admin.charts') ? 'active' : '' }}">
            <i class="fas fa-chart-pie"></i> Charts
        </a>
        <a href="{{ route('admin.datatables') }}" class="{{ request()->routeIs('admin.datatables') ? 'active' : '' }}">
            <i class="fas fa-table"></i> Data Tables
        </a>
        <div class="divider"></div>
        <div class="section-title">System</div>
        <a href="{{ route('admin.settings') }}" class="{{ request()->routeIs('admin.settings') ? 'active' : '' }}">
            <i class="fas fa-cog"></i> Settings
        </a>
        <a href="{{ route('admin.notifications') }}" class="{{ request()->routeIs('admin.notifications') ? 'active' : '' }}">
            <i class="fas fa-bell"></i> Notifications
        </a>
        <a href="{{ route('admin.security') }}" class="{{ request()->routeIs('admin.security') ? 'active' : '' }}">
            <i class="fas fa-lock"></i> Security
        </a>
        <div class="divider"></div>
        <div class="section-title">Account</div>
        <a href="{{ route('admin.profile') }}" class="{{ request()->routeIs('admin.profile') ? 'active' : '' }}">
            <i class="fas fa-user-circle"></i> My Profile
        </a>
        <form method="POST" action="{{ route('logout') }}" style="margin:0">
            @csrf
            <button type="submit" style="background:none;border:none;width:100%;text-align:left;display:flex;align-items:center;gap:12px;padding:11px 20px;color:#e53e3e;font-size:14px;cursor:pointer;">
                <i class="fas fa-sign-out-alt" style="width:18px;text-align:center"></i> Logout
            </button>
        </form>
    </div>

    <div class="main-content">
        <div class="topbar">
            <div>
                <i class="fas fa-bars me-2 text-muted"></i>
                <span class="text-muted">Welcome back,</span>
                <strong> {{ auth()->user()->name }}</strong>
            </div>
            <div class="d-flex align-items-center gap-3">
                <!-- Bell Dropdown -->
                <div class="dropdown position-relative me-2">
                    <a href="{{ route('admin.notifications') }}" class="text-muted position-relative">
                        <i class="fas fa-bell fs-5"></i>
                        @php
                        $lastRead = session('notifications_read_at');
                        if ($lastRead) {
                        $notifCount = \App\Models\User::where('created_at', '>', $lastRead)->count();
                        } else {
                        $notifCount = \App\Models\User::where('created_at', '>=', now()->subDays(1))->count();
                        }
                        @endphp
                        @if($notifCount > 0)
                        <span style="
                                position: absolute;
                                top: -8px;
                                right: -8px;
                                background: #e53e3e;
                                color: #fff;
                                border-radius: 50%;
                                width: 18px;
                                height: 18px;
                                font-size: 10px;
                                display: flex;
                                align-items: center;
                                justify-content: center;
                                font-weight: bold;
                            ">{{ $notifCount }}</span>
                        @endif
                    </a>
                </div>

                <!-- User Dropdown -->
                <div class="dropdown">
                    <a href="#" class="d-flex align-items-center gap-2 text-decoration-none text-dark" data-bs-toggle="dropdown">
                        @if(auth()->user()->profile_photo)
                        <img src="{{ asset('uploads/profiles/' . auth()->user()->profile_photo) }}"
                            style="width:35px;height:35px;border-radius:50%;object-fit:cover;">
                        @else
                        <div style="width:35px;height:35px;background:linear-gradient(135deg,#667eea,#764ba2);border-radius:50%;display:flex;align-items:center;justify-content:center;">
                            <span style="color:#fff;font-size:14px;font-weight:bold;">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </span>
                        </div>
                        @endif
                        <span class="small fw-bold">{{ auth()->user()->name }}</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end shadow">
                        <li>
                            <div class="px-3 py-2 border-bottom">
                                <div class="fw-bold">{{ auth()->user()->name }}</div>
                                <div class="text-muted small">{{ auth()->user()->email }}</div>
                            </div>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('admin.profile') }}">
                                <i class="fas fa-user-circle me-2"></i> My Profile
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('admin.settings') }}">
                                <i class="fas fa-cog me-2"></i> Settings
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('admin.security') }}">
                                <i class="fas fa-lock me-2"></i> Security
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="dropdown-item text-danger">
                                    <i class="fas fa-sign-out-alt me-2"></i> Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="p-4">
            @yield('content')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @yield('scripts')
</body>

</html>