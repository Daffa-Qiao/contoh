@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">Dashboard</div>
            <div class="card-body">
                <h4>Selamat datang di Dashboard!</h4>
                <p>Anda login sebagai <strong>{{ auth()->user()->role }}</strong>.</p>
            </div>
        </div>
    </div>
</div>
@endsection 