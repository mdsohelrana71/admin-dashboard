@extends('layouts.admin')

@section('content')

<div class="row">
    <div class="col-md-4">
        <div class="stat-card" style="background: linear-gradient(135deg, #667eea, #764ba2)">
            <i class="fas fa-users stat-icon"></i>
            <h6><i class="fas fa-users"></i> Total Users</h6>
            <h2>{{ $totalUsers }}</h2>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card" style="background: linear-gradient(135deg, #11998e, #38ef7d)">
            <i class="fas fa-user-shield stat-icon"></i>
            <h6><i class="fas fa-user-shield"></i> Total Admins</h6>
            <h2>{{ $totalAdmins }}</h2>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card" style="background: linear-gradient(135deg, #f093fb, #f5576c)">
            <i class="fas fa-database stat-icon"></i>
            <h6><i class="fas fa-database"></i> Total Accounts</h6>
            <h2>{{ $totalAccounts }}</h2>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-12">
        <div class="card shadow-sm">
            <div class="card-header bg-white fw-bold">
                <i class="fas fa-clock"></i> Latest Registered Users
            </div>
            <div class="card-body">
                <table class="table table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Registered</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($latestUsers as $user)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @if($user->role == 'admin')
                                    <span class="badge bg-success">Admin</span>
                                @else
                                    <span class="badge bg-primary">User</span>
                                @endif
                            </td>
                            <td>{{ $user->created_at->format('d M Y, h:i A') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection