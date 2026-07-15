@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-header bg-white fw-bold">
                <i class="fas fa-cog"></i> Account Settings
            </div>
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <form method="POST" action="{{ route('admin.settings.update') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Full Name</label>
                        <input type="text" name="name" class="form-control" value="{{ auth()->user()->name }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email Address</label>
                        <input type="email" name="email" class="form-control" value="{{ auth()->user()->email }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Role</label>
                        <input type="text" class="form-control" value="{{ auth()->user()->role }}" disabled>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Member Since</label>
                        <input type="text" class="form-control" value="{{ auth()->user()->created_at->format('d M Y') }}" disabled>
                    </div>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Save Changes
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-4">
    <div class="card shadow-sm">
        <div class="card-header bg-white fw-bold">
            <i class="fas fa-user-circle"></i> Profile Picture
        </div>
        <div class="card-body text-center">
            @if(auth()->user()->profile_photo)
                <img src="{{ asset('uploads/profiles/' . auth()->user()->profile_photo) }}"
                     style="width:100px;height:100px;border-radius:50%;object-fit:cover;margin-bottom:15px;">
            @else
                <div style="width:100px;height:100px;background:linear-gradient(135deg,#667eea,#764ba2);border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 15px;">
                    <span style="color:#fff;font-size:36px;font-weight:bold;">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </span>
                </div>
            @endif
            <h6>{{ auth()->user()->name }}</h6>
            <p class="text-muted small">{{ auth()->user()->email }}</p>
            <span class="badge bg-success">{{ auth()->user()->role }}</span>
            <hr>
            <form method="POST" action="{{ route('admin.profile.photo') }}" enctype="multipart/form-data">
                @csrf
                @if(session('photo_success'))
                    <div class="alert alert-success small">{{ session('photo_success') }}</div>
                @endif
                <div class="mb-2">
                    <input type="file" name="profile_photo" class="form-control form-control-sm" accept="image/*">
                </div>
                <button type="submit" class="btn btn-primary btn-sm w-100">
                    <i class="fas fa-upload"></i> Upload Photo
                </button>
            </form>
        </div>
    </div>
</div>
</div>
@endsection