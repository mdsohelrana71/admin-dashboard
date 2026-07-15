@extends('layouts.admin')

@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-white fw-bold">
        <i class="fas fa-bell"></i> Notifications
    </div>
    <div class="card-body p-0">
        @forelse($latestUsers as $user)
        <div class="d-flex align-items-center p-3 border-bottom">
            <div style="width:45px;height:45px;background:linear-gradient(135deg,#667eea,#764ba2);border-radius:50%;display:flex;align-items:center;justify-content:center;margin-right:15px;flex-shrink:0;">
                <span style="color:#fff;font-size:18px;font-weight:bold;">
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                </span>
            </div>
            <div class="flex-grow-1">
                <div class="fw-bold">{{ $user->name }}</div>
                <div class="text-muted small">
                    @if($user->role == 'admin')
                        <span class="badge bg-success">Admin</span>
                    @else
                        <span class="badge bg-primary">User</span>
                    @endif
                    {{ $user->email }} registered
                </div>
            </div>
            <div class="text-muted small">
                {{ $user->created_at->diffForHumans() }}
            </div>
        </div>
        @empty
        <div class="p-4 text-center text-muted">
            <i class="fas fa-bell-slash fa-2x mb-2"></i>
            <p>No notifications yet.</p>
        </div>
        @endforelse
    </div>
</div>
@endsection