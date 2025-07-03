@extends('layouts.app')
@section('title', 'Dashboard Pasien')
@section('content')
@include('layouts.navbars.dashboardnav')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header" style="background-color:green; color:white;" d-flex align-items-center>
                    <i class="fas fa-user-injured fa-2x me-2" style="color:white;"></i>
                    <span>Dashboard Pasien</span>
                </div>
                <div class="card-body">
                    <h4 class="mb-3">Selamat datang, <strong>{{ auth()->user()->name }}</strong>!</h4>
                    <p class="mb-4">Anda login sebagai <strong>Pasien</strong>.</p>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card text-center border-0 shadow-sm mb-3">
                                <div class="card-body">
                                    <i class="fas fa-calendar-check fa-2x mb-2" style="color:green;"></i>
                                    <h5 class="card-title">Reservasi Anda</h5>
                                    <p class="card-text display-6">{{ $jumlahReservasi ?? 0 }}</p>
                                    <small class="text-muted">Total reservasi yang sudah Anda lakukan</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card text-center border-0 shadow-sm mb-3">
                                <div class="card-body">
                                    <i class="fas fa-plus-circle fa-2x mb-2" style="color:green;"></i>
                                    <h5 class="card-title">Buat Reservasi Baru</h5>
                                    <a href="{{ route('pasien.reservations.create') }}" class="btn mt-2" style="background-color:green; color:white;">Reservasi Sekarang</a>
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