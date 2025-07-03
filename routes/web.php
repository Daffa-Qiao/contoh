<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReservationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('index');
});

// Auth routes
Route::get('login', [UserController::class, 'showLogin'])->name('login');
Route::post('login', [UserController::class, 'login']);
Route::get('register', [UserController::class, 'showRegister'])->name('register');
Route::post('register', [UserController::class, 'register']);
Route::post('logout', [UserController::class, 'logout'])->name('logout');

// Dashboard untuk masing-masing role
Route::get('dashboard/pasien', [UserController::class, 'dashboard_pasien'])->middleware(['auth', 'role:pasien'])->name('dashboard.pasien');
Route::get('dashboard/dokter', [UserController::class, 'dashboard_dokter'])->middleware(['auth', 'role:dokter'])->name('dashboard.dokter');
Route::get('dashboard/admin', function () {
    return view('dashboard-admin');
})->middleware(['auth', 'role:admin'])->name('dashboard.admin');

// Hitung Kalori
Route::get('hitung-kalori', function () {
    return view('kalori');
});

// Makanan Sehat
Route::get('makanan-sehat', function () {
    return view('makanan-sehat');
});

// Group route reservasi
Route::middleware(['auth', 'role:pasien'])->prefix('pasien')->name('pasien.')->group(function () {
    Route::resource('reservations', ReservationController::class)->only(['index', 'create', 'store', 'show']);
});

Route::middleware(['auth', 'role:dokter'])->prefix('dokter')->name('dokter.')->group(function () {
    Route::get('reservations', [ReservationController::class, 'index'])->name('reservations.index');
    Route::get('reservations/{reservation}', [ReservationController::class, 'show'])->name('reservations.show');
    Route::post('reservations/{reservation}/accept', [ReservationController::class, 'accept'])->name('reservations.accept');
    Route::post('reservations/{reservation}/reject', [ReservationController::class, 'reject'])->name('reservations.reject');
});

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('reservations', \App\Http\Controllers\Admin\ReservationController::class)->except(['create']);
    Route::resource('users', \App\Http\Controllers\Admin\UserManagementController::class)->except(['create']);
});
