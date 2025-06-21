<?php

namespace App\Http\Controllers\WEB;

// use App\Http\Requests\RegisterRequest;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Repositories\SubdistrictRepository;
use Illuminate\Support\Facades\Storage;

class RegisterController extends Controller
{
    private $subdistrictRepository;

    public function __construct(SubdistrictRepository $subdistrictRepository)
    {
        $this->subdistrictRepository = $subdistrictRepository;
    }

    public function create()
    {
        return view('register', [
            'subdistricts' => $this->subdistrictRepository->all()
        ]);
    }

    public function store()
    {
        $attributes = request()->validate([
            'name' => 'required|min:3',
            'email' => 'nullable|email|unique:users,email',
            'phone' => 'nullable|min:5',
            'password' => 'required|min:8',
            'password_confirmation' => 'required|same:password',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'subdistrict_id' => 'required|exists:subdistricts,id',
            'terms' => 'required'
        ]);

        // Remove terms from attributes as it's not part of the user model
        unset($attributes['terms']);
        unset($attributes['password_confirmation']);

        // Handle photo upload if provided
        if (request()->hasFile('photo')) {
            $path = 'public/' . Storage::disk('public')->put('images/users', request()->file('photo'));
            $attributes['photo'] = $path;
        }

        // Hash password
        $attributes['password'] = bcrypt($attributes['password']);

        // Create user
        $user = User::create($attributes);
        
        // Log the user in
        auth()->login($user);

        return redirect('/beranda')->with('success', 'Akun berhasil dibuat! Selamat datang di Sehat Rasa.');
    }
}
