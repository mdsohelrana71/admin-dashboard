@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-md-4">
    <div class="card shadow-sm text-center">
        <div class="card-body py-4">
            @if(auth()->user()->profile_photo)
                <img src="{{ asset('uploads/profiles/' . auth()->user()->profile_photo) }}"
                     style="width:100px;height:100px;border-radius:50%;object-fit:cover;margin-bottom:15px;">
            @else
                <div style="width:100px;height:100px;background:linear-gradient(135deg,#667eea,#764ba2);border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 15px;">
                    <span style="color:#fff;font-size:40px;font-weight:bold;">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </span>
                </div>
            @endif

            <h5 class="fw-bold">{{ auth()->user()->name }}</h5>
            <p class="text-muted">{{ auth()->user()->email }}</p>
            <span class="badge bg-success px-3 py-2">{{ ucfirst(auth()->user()->role) }}</span>
            <hr>
            <p class="text-muted small">
                <i class="fas fa-calendar me-1"></i>
                Member since {{ auth()->user()->created_at->format('d M Y') }}
            </p>

            {{-- Upload Photo Form --}}
            <form method="POST" action="{{ route('admin.profile.photo') }}" enctype="multipart/form-data">
                @csrf
                @if(session('success'))
                    <div class="alert alert-success small">{{ session('success') }}</div>
                @endif
                <div class="mb-2">
                    <input type="file" name="profile_photo" class="form-control form-control-sm" accept="image/*">
                </div>
                <button type="submit" class="btn btn-primary btn-sm">
                    <i class="fas fa-upload"></i> Upload Photo
                </button>
            </form>
        </div>
    </div>
</div>

    <div class="col-md-8">
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-white fw-bold">
                <i class="fas fa-info-circle"></i> Profile Information
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <td class="text-muted" width="150">Full Name</td>
                        <td><strong>{{ auth()->user()->name }}</strong></td>
                    </tr>
                    <tr>
                        <td class="text-muted">Email</td>
                        <td><strong>{{ auth()->user()->email }}</strong></td>
                    </tr>
                    <tr>
                        <td class="text-muted">Role</td>
                        <td><span class="badge bg-success">{{ ucfirst(auth()->user()->role) }}</span></td>
                    </tr>
                    <tr>
                        <td class="text-muted">Joined</td>
                        <td><strong>{{ auth()->user()->created_at->format('d M Y, h:i A') }}</strong></td>
                    </tr>
                </table>
                <a href="{{ route('admin.settings') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-edit"></i> Edit Profile
                </a>
                <a href="{{ route('admin.security') }}" class="btn btn-danger btn-sm">
                    <i class="fas fa-key"></i> Change Password
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="card shadow-sm text-center p-3" style="background:linear-gradient(135deg,#667eea,#764ba2);color:#fff;border-radius:12px;">
                    <h6>Total Users</h6>
                    <h2>{{ $totalUsers }}</h2>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card shadow-sm text-center p-3" style="background:linear-gradient(135deg,#11998e,#38ef7d);color:#fff;border-radius:12px;">
                    <h6>Total Admins</h6>
                    <h2>{{ $totalAdmins }}</h2>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection