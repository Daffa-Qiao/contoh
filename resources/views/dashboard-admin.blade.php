@extends('layouts.app')
@section('title', 'Dashboard Admin')
@section('content')
@include('layouts.navbars.dashboardnav')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow border-0 mb-4">
                <div class="card-header bg-gradient-primary text-white d-flex align-items-center">
                    <i class="fas fa-user-shield fa-2x me-2"></i>
                    <span class="ms-2">Dashboard Admin</span>
                </div>
                <div class="card-body">
                    <h4 class="mb-3">Selamat datang, <strong>{{ auth()->user()->name }}</strong>!</h4>
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="card text-center border-0 shadow-sm mb-3">
                                <div class="card-body">
                                    <i class="fas fa-users fa-2x text-primary mb-2"></i>
                                    <h5 class="card-title">Total User</h5>
                                    <p class="display-6">{{ $totalUser }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card text-center border-0 shadow-sm mb-3">
                                <div class="card-body">
                                    <i class="fas fa-calendar-check fa-2x text-success mb-2"></i>
                                    <h5 class="card-title">Total Reservasi</h5>
                                    <p class="display-6">{{ $totalReservasi }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card border-0 shadow-sm mb-3">
                                <div class="card-body">
                                    <h5 class="card-title mb-3">Statistik Reservasi per Bulan</h5>
                                    <canvas id="chartReservasiAdmin"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card text-center border-0 shadow-sm mb-3">
                                <div class="card-body">
                                    <i class="fas fa-users-cog fa-2x text-info mb-2"></i>
                                    <h5 class="card-title">Manajemen Akun</h5>
                                    <a href="{{ route('admin.users.index') }}" class="btn btn-outline-primary btn-sm mt-2">Lihat Akun</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card text-center border-0 shadow-sm mb-3">
                                <div class="card-body">
                                    <i class="fas fa-calendar-check fa-2x text-success mb-2"></i>
                                    <h5 class="card-title">Manajemen Reservasi</h5>
                                    <a href="{{ route('admin.reservations.index') }}" class="btn btn-outline-success btn-sm mt-2">Lihat Reservasi</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctxAdmin = document.getElementById('chartReservasiAdmin').getContext('2d');
    new Chart(ctxAdmin, {
        type: 'bar',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
            datasets: [{
                label: 'Reservasi',
                data: @json($chartData),
                backgroundColor: 'rgba(54, 162, 235, 0.5)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
@endsection
