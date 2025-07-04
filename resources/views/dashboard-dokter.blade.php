@extends('layouts.app')
@section('title', 'Dashboard Dokter')
@section('content')
@include('layouts.navbars.dashboardnav')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow border-0 mb-4">
                <div class="card-header bg-gradient-primary text-white d-flex align-items-center">
                    <i class="fas fa-user-md fa-2x me-2 text-danger"></i>
                    <span class="ms-2">Dashboard Dokter</span>
                </div>
                <div class="card-body">
                    <h4 class="mb-3">Selamat datang, <strong>{{ auth()->user()->name }}</strong>!</h4>
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="card text-center border-0 shadow-sm mb-3">
                                <div class="card-body">
                                    <i class="fas fa-hourglass-half fa-2x text-danger mb-2"></i>
                                    <h5 class="card-title">Menunggu Persetujuan</h5>
                                    <p class="card-text display-6">{{ $menunggu ?? 0 }}</p>
                                    <small class="text-muted">Reservasi yang masih menunggu persetujuan Anda</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card text-center border-0 shadow-sm mb-3">
                                <div class="card-body">
                                    <i class="fas fa-check-circle fa-2x text-danger mb-2"></i>
                                    <h5 class="card-title">Sudah Diterima</h5>
                                    <p class="card-text display-6">{{ $diterima ?? 0 }}</p>
                                    <small class="text-muted">Reservasi yang sudah Anda terima</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card border-0 shadow-sm mb-3">
                                <div class="card-body">
                                    <h5 class="card-title mb-3">Statistik Reservasi per Bulan</h5>
                                    <canvas id="chartReservasiDokter"></canvas>
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
    const ctxDokter = document.getElementById('chartReservasiDokter').getContext('2d');
    new Chart(ctxDokter, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
            datasets: [{
                label: 'Reservasi',
                data: @json($chartData),
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 2,
                fill: true,
                tension: 0.4
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