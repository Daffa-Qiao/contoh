@extends('layouts.app')
@section('title', 'Dashboard Dokter')
@include('layouts.navbars.dashboardnav')
@section('content')
<div class="container py-4">
    <div class="card">
        <div class="card-header bg-primary text-white">Dashboard Dokter</div>
        <div class="card-body">
            <h4>Selamat datang, {{ auth()->user()->name }}!</h4> 
        </div>
    </div>
</div>
@endsection 