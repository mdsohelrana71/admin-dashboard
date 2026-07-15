@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-header bg-white fw-bold">
                <i class="fas fa-lock"></i> Change Password
            </div>
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                <form method="POST" action="{{ route('admin.security.update') }}">
                    @csrf
                    <div class="mb-3" style="position:relative;">
                        <label class="form-label">Current Password</label>
                        <input type="password" name="current_password" id="current_password" class="form-control" style="padding-right:40px;" required>
                        <i class="fas fa-eye" id="toggleCurrent"
                            style="position:absolute;right:12px;top:68%;transform:translateY(-50%);cursor:pointer;color:#a0aec0;"
                            onclick="togglePass('current_password','toggleCurrent')"></i>
                    </div>
                    <div class="mb-3" style="position:relative;">
                        <label class="form-label">New Password</label>
                        <input type="password" name="password" id="new_password" class="form-control" style="padding-right:40px;" required>
                        <i class="fas fa-eye" id="toggleNew"
                            style="position:absolute;right:12px;top:68%;transform:translateY(-50%);cursor:pointer;color:#a0aec0;"
                            onclick="togglePass('new_password','toggleNew')"></i>
                    </div>
                    <div class="mb-3" style="position:relative;">
                        <label class="form-label">Confirm New Password</label>
                        <input type="password" name="password_confirmation" id="confirm_password" class="form-control" style="padding-right:40px;" required>
                        <i class="fas fa-eye" id="toggleConfirm"
                            style="position:absolute;right:12px;top:68%;transform:translateY(-50%);cursor:pointer;color:#a0aec0;"
                            onclick="togglePass('confirm_password','toggleConfirm')"></i>
                    </div>
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-key"></i> Update Password
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card shadow-sm">
            <div class="card-header bg-white fw-bold">
                <i class="fas fa-shield-alt"></i> Security Info
            </div>
            <div class="card-body">
                <ul class="list-unstyled">
                    <li class="mb-3">
                        <i class="fas fa-check-circle text-success me-2"></i>
                        <strong>Account Active</strong>
                        <p class="text-muted small mb-0">Your account is active and secure</p>
                    </li>
                    <li class="mb-3">
                        <i class="fas fa-check-circle text-success me-2"></i>
                        <strong>Email Verified</strong>
                        <p class="text-muted small mb-0">{{ auth()->user()->email }}</p>
                    </li>
                    <li class="mb-3">
                        <i class="fas fa-check-circle text-success me-2"></i>
                        <strong>Role</strong>
                        <p class="text-muted small mb-0">{{ ucfirst(auth()->user()->role) }}</p>
                    </li>
                    <li>
                        <i class="fas fa-clock text-primary me-2"></i>
                        <strong>Member Since</strong>
                        <p class="text-muted small mb-0">{{ auth()->user()->created_at->format('d M Y') }}</p>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection