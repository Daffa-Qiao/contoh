@extends('layouts.app')
@section('title', 'Dashboard Dokter')
@section('content')
@include('layouts.navbars.dashboardnav')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header bg-primary text-white d-flex align-items-center">
                    <i class="fas fa-user-md fa-2x me-2"></i>
                    <span>Dashboard Dokter</span>
                </div>
                <div class="card-body">
                    <h4 class="mb-3">Selamat datang, <strong>{{ auth()->user()->name }}</strong>!</h4>
                    <p class="mb-4">Anda login sebagai <strong>Dokter</strong>.</p>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card text-center border-0 shadow-sm mb-3">
                                <div class="card-body">
                                    <i class="fas fa-hourglass-half fa-2x text-warning mb-2"></i>
                                    <h5 class="card-title">Menunggu Persetujuan</h5>
                                    <p class="card-text display-6">{{ $menunggu ?? 0 }}</p>
                                    <small class="text-muted">Reservasi yang masih menunggu persetujuan Anda</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card text-center border-0 shadow-sm mb-3">
                                <div class="card-body">
                                    <i class="fas fa-check-circle fa-2x text-success mb-2"></i>
                                    <h5 class="card-title">Sudah Diterima</h5>
                                    <p class="card-text display-6">{{ $diterima ?? 0 }}</p>
                                    <small class="text-muted">Reservasi yang sudah Anda terima</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 