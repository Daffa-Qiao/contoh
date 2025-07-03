<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return $this->redirectToDashboard();
        }
        return back()->withErrors(['email' => 'Email atau password salah.']);
    }

    public function showRegister()
    {
        $subdistricts = DB::table('subdistricts')->orderBy('name')->get();
        return view('auth.register', compact('subdistricts'));
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string|max:20',
            'subdistrict_id' => 'required|exists:subdistricts,id',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'password' => 'required|confirmed|min:8',
            'terms' => 'accepted',
            'role' => 'required|in:pasien,dokter,admin',
        ]);

        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('photos', 'public');
        }

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
            'role' => $validated['role'],
            'subdistrict_id' => $validated['subdistrict_id'],
            'phone' => $validated['phone'],
            'photo' => $photoPath,
        ]);
        Auth::login($user);
        return $this->redirectToDashboard();
    }

    private function redirectToDashboard()
    {
        $role = Auth::user()->role;
        if ($role === 'admin') {
            return redirect()->route('dashboard.admin');
        } elseif ($role === 'dokter') {
            return redirect()->route('dashboard.dokter');
        } else {
            return redirect()->route('dashboard.pasien');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('login');
    }

    public function dashboard_pasien()
    {
        $jumlahReservasi = \App\Models\Reservation::where('pasien_id', auth()->id())->count();
        return view('dashboard-pasien', compact('jumlahReservasi'));
    }

    public function dashboard_dokter()
    {
        $menunggu = \App\Models\Reservation::where('dokter_id', auth()->id())->where('status', 'pending')->count();
        $diterima = \App\Models\Reservation::where('dokter_id', auth()->id())->where('status', 'accepted')->count();
        return view('dashboard-dokter', compact('menunggu', 'diterima'));
    }
} 