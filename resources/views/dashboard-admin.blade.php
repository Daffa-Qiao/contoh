@extends('layouts.app')
@section('title', 'Dashboard Admin')
@section('content')
@include('layouts.navbars.dashboardnav')
<div class="container py-4">
    <div class="card">
        <div class="card-header bg-dark text-white">Dashboard Admin</div>
        <div class="card-body">
            <h4>Selamat datang, {{ auth()->user()->name }}!</h4>
            <p>Anda login sebagai <strong>Admin</strong>.</p>
        </div>
    </div>
</div>
@endsection 