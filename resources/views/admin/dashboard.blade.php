@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-md-4">
        <a href="{{ route('admin.users') }}" style="text-decoration:none;">
            <div class="stat-card" style="background: linear-gradient(135deg, #667eea, #764ba2)">
                <h6><i class="fas fa-users"></i> Total Users</h6>
                <h2>{{ $totalUsers }}</h2>
            </div>
        </a>    
    </div>
    <div class="col-md-4">
        <a href="{{ route('admin.admins') }}" style="text-decoration:none;">
            <div class="stat-card" style="background: linear-gradient(135deg, #11998e, #38ef7d)">
                <h6><i class="fas fa-user-shield"></i> Total Admins</h6>
                <h2>{{ $totalAdmins }}</h2>
            </div>
        </a>    
    </div>
    <div class="col-md-4">
        <a href="{{ route('admin.datatables') }}" style="text-decoration:none;">
            <div class="stat-card" style="background: linear-gradient(135deg, #f093fb, #f5576c)">
                <h6><i class="fas fa-database"></i> Total Accounts</h6>
                <h2>{{ $totalUsers + $totalAdmins }}</h2>
            </div>
        </a>
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-header bg-white fw-bold">Users vs Admins (Bar)</div>
            <div class="card-body">
                <canvas id="barChart"></canvas>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-header bg-white fw-bold">Users vs Admins (Pie)</div>
            <div class="card-body">
                <canvas id="pieChart"></canvas>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
new Chart(document.getElementById('barChart'), {
    type: 'bar',
    data: {
        labels: ['Users', 'Admins'],
        datasets: [{
            label: 'Count',
            data: [{{ $totalUsers }}, {{ $totalAdmins }}],
            backgroundColor: ['#667eea', '#11998e'],
            borderRadius: 8
        }]
    },
    options: { plugins: { legend: { display: false } } }
});

new Chart(document.getElementById('pieChart'), {
    type: 'doughnut',
    data: {
        labels: ['Users', 'Admins'],
        datasets: [{
            data: [{{ $totalUsers }}, {{ $totalAdmins }}],
            backgroundColor: ['#667eea', '#11998e']
        }]
    }
});
</script>
@endsection