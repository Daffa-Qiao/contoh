<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    // List reservasi sesuai role
    public function index()
    {
        $user = Auth::user();
        if ($user->role === 'admin') {
            $reservations = Reservation::with(['pasien', 'dokter'])->latest()->get();
        } elseif ($user->role === 'dokter') {
            $reservations = Reservation::with(['pasien', 'dokter'])->where('dokter_id', $user->id)->latest()->get();
        } else {
            $reservations = Reservation::with(['pasien', 'dokter'])->where('pasien_id', $user->id)->latest()->get();
        }
        return view('reservations.index', compact('reservations'));
    }

    // Form buat reservasi (pasien)
    public function create()
    {
        $dokters = User::where('role', 'dokter')->get();
        return view('reservations.create', compact('dokters'));
    }

    // Simpan reservasi (pasien)
    public function store(Request $request)
    {
        $request->validate([
            'dokter_id' => 'required|exists:users,id',
            'jadwal' => 'required|date|after:now',
            'keterangan' => 'nullable|string',
        ]);
        Reservation::create([
            'pasien_id' => Auth::id(),
            'dokter_id' => $request->dokter_id,
            'jadwal' => $request->jadwal,
            'keterangan' => $request->keterangan,
            'status' => 'pending',
        ]);
        return redirect()->route(auth()->user()->role . '.reservations.index')->with('success', 'Reservasi berhasil dibuat!');
    }

    // Tampilkan detail reservasi
    public function show(Reservation $reservation)
    {
        $reservation->load(['pasien', 'dokter']);
        return view('reservations.show', compact('reservation'));
    }

    // Edit reservasi (admin)
    public function edit(Reservation $reservation)
    {
        $dokters = User::where('role', 'dokter')->get();
        return view('reservations.edit', compact('reservation', 'dokters'));
    }

    // Update reservasi (admin)
    public function update(Request $request, Reservation $reservation)
    {
        $request->validate([
            'dokter_id' => 'required|exists:users,id',
            'jadwal' => 'required|date|after:now',
            'keterangan' => 'nullable|string',
            'status' => 'required|in:pending,accepted,rejected',
        ]);
        $reservation->update($request->only(['dokter_id', 'jadwal', 'keterangan', 'status']));
        return redirect()->route(auth()->user()->role . '.reservations.index')->with('success', 'Reservasi berhasil diupdate!');
    }

    // Hapus reservasi (admin)
    public function destroy(Reservation $reservation)
    {
        $reservation->delete();
        return redirect()->route(auth()->user()->role . '.reservations.index')->with('success', 'Reservasi berhasil dihapus!');
    }

    // Dokter menerima reservasi
    public function accept(Reservation $reservation)
    {
        $this->authorize('update', $reservation);
        $reservation->update(['status' => 'accepted']);
        return redirect()->route(auth()->user()->role . '.reservations.index')->with('success', 'Reservasi diterima.');
    }

    // Dokter menolak reservasi
    public function reject(Reservation $reservation)
    {
        $this->authorize('update', $reservation);
        $reservation->update(['status' => 'rejected']);
        return redirect()->route(auth()->user()->role . '.reservations.index')->with('success', 'Reservasi ditolak.');
    }
} 