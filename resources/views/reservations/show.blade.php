@extends('layouts.app')
@section('title', 'Detail Reservasi')
@section('content')
@include('layouts.navbars.dashboardnav')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-info text-white">Detail Reservasi</div>
                <div class="card-body">
                    <dl class="row">
                        <dt class="col-sm-4">Pasien</dt>
                        <dd class="col-sm-8">{{ $reservation->pasien->name ?? '-' }}</dd>
                        <dt class="col-sm-4">Dokter</dt>
                        <dd class="col-sm-8">{{ $reservation->dokter->name ?? '-' }}</dd>
                        <dt class="col-sm-4">Jadwal</dt>
                        <dd class="col-sm-8">{{ $reservation->jadwal }}</dd>
                        <dt class="col-sm-4">Status</dt>
                        <dd class="col-sm-8">
                            @if($reservation->status === 'pending')
                                <span class="badge bg-warning text-dark">Pending</span>
                            @elseif($reservation->status === 'accepted')
                                <span class="badge bg-success">Diterima</span>
                            @else
                                <span class="badge bg-danger">Ditolak</span>
                            @endif
                        </dd>
                        <dt class="col-sm-4">Keterangan</dt>
                        <dd class="col-sm-8">{{ $reservation->keterangan }}</dd>
                    </dl>
                    <a href="{{ url()->previous() }}" class="btn btn-secondary">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 