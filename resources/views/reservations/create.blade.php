@extends('layouts.app')
@section('title', 'Buat Reservasi')
@section('content')
@include('layouts.navbars.dashboardnav')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-success text-white">Buat Reservasi</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('pasien.reservations.store') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="dokter_id" class="form-label">Pilih Dokter</label>
                            <select name="dokter_id" id="dokter_id" class="form-select" required>
                                <option value="" disabled selected>Pilih Dokter</option>
                                @foreach($dokters as $dokter)
                                    <option value="{{ $dokter->id }}">{{ $dokter->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="jadwal" class="form-label">Jadwal Konsultasi</label>
                            <input type="datetime-local" name="jadwal" id="jadwal" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="keterangan" class="form-label">Keterangan (opsional)</label>
                            <textarea name="keterangan" id="keterangan" class="form-control"></textarea>
                        </div>
                        <button type="submit" class="btn btn-success">Kirim Reservasi</button>
                        <a href="{{ route('pasien.reservations.index') }}" class="btn btn-secondary">Batal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 