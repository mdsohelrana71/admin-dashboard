@extends('layouts.admin')

@section('content')

<div class="row">
    <div class="col-md-6">
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-white fw-bold">
                <i class="fas fa-chart-bar"></i> Users vs Admins (Bar)
            </div>
            <div class="card-body">
                <canvas id="barChart"></canvas>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-white fw-bold">
                <i class="fas fa-chart-pie"></i> Users vs Admins (Doughnut)
            </div>
            <div class="card-body">
                <canvas id="doughnutChart"></canvas>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-white fw-bold">
                <i class="fas fa-chart-line"></i> Monthly Registrations (Last 6 Months)
            </div>
            <div class="card-body">
                <canvas id="lineChart"></canvas>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
// Bar Chart
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
    options: {
        plugins: { legend: { display: false } },
        scales: { y: { beginAtZero: true } }
    }
});

// Doughnut Chart
new Chart(document.getElementById('doughnutChart'), {
    type: 'doughnut',
    data: {
        labels: ['Users', 'Admins'],
        datasets: [{
            data: [{{ $totalUsers }}, {{ $totalAdmins }}],
            backgroundColor: ['#667eea', '#11998e']
        }]
    }
});

// Line Chart
new Chart(document.getElementById('lineChart'), {
    type: 'line',
    data: {
        labels: {!! json_encode($monthLabels) !!},
        datasets: [{
            label: 'Registrations',
            data: {!! json_encode($monthlyUsers) !!},
            borderColor: '#667eea',
            backgroundColor: 'rgba(102,126,234,0.1)',
            tension: 0.4,
            fill: true
        }]
    },
    options: {
        scales: { y: { beginAtZero: true } }
    }
});
</script>
@endsection