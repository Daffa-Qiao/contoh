@extends('layouts.app')
@section('title', 'Dashboard Pasien')
@section('content')
@include('layouts.navbars.dashboardnav')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow border-0 mb-4">
                <div class="card-header bg-gradient-success text-white d-flex align-items-center">
                    <i class="fas fa-user-injured fa-2x me-2"></i>
                    <span class="ms-2">Dashboard Pasien</span>
                </div>
                <div class="card-body">
                    <h4 class="mb-3">Selamat datang, <strong>{{ auth()->user()->name }}</strong>!</h4>
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="card text-center border-0 shadow-sm mb-3">
                                <div class="card-body">
                                    <i class="fas fa-calendar-check fa-2x text-success mb-2"></i>
                                    <h5 class="card-title">Reservasi Anda</h5>
                                    <p class="card-text display-6">{{ $jumlahReservasi ?? 0 }}</p>
                                    <small class="text-muted">Total reservasi yang sudah Anda lakukan</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card text-center border-0 shadow-sm mb-3">
                                <div class="card-body">
                                    <i class="fas fa-plus-circle fa-2x text-success mb-2"></i>
                                    <h5 class="card-title">Buat Reservasi Baru</h5>
                                    <a href="{{ route('pasien.reservations.create') }}" class="btn btn-success mt-2 text-white">Reservasi Sekarang</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card border-0 shadow-sm mb-3">
                                <div class="card-body">
                                    <h5 class="card-title mb-3">Statistik Reservasi per Bulan</h5>
                                    <canvas id="chartReservasiPasien"></canvas>
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
    const ctxPasien = document.getElementById('chartReservasiPasien').getContext('2d');
    new Chart(ctxPasien, {
        type: 'bar',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
            datasets: [{
                label: 'Reservasi',
                data: @json($chartData),
                backgroundColor: 'rgba(40, 167, 69, 0.5)',
                borderColor: 'rgba(40, 167, 69, 1)',
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

