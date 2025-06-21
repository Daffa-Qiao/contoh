<?php

namespace App\Http\Controllers\WEB;

use App\Http\Controllers\Controller;
use App\Repositories\DocterRepository;
use App\Repositories\ReservationRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    private $userRepository;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    /**
     * Class constructor.
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $countUser = $this->userRepository->countUsers();
        
        return view('pages.dashboard', [
            "count_user" => $countUser,
            "total_docters" => DocterRepository::countDocter(),
            "total_reservation" => ReservationRepository::countReservation(),
        ]);
    }
    public function beranda()
    {
        return view('pages.index');
    }
    public function hitungKalori()
    {
        return view('hitung-kalori');
    }
    public function menuSehat()
    {
        return view('menu-sehat');
    }
    
}