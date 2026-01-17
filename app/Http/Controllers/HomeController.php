<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Announcement;
use App\Materi;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index']);
    }

    public function index()
    {
        // admin -> dashboard admin
        if (Auth::check() && Auth::user()->user_type === 'admin') {
            return app(AdminController::class)->index();
        }

        // announcements
        $announcements = Announcement::active()
            ->latest()
            ->take(5)
            ->get();

        // materi video buat dashboard peserta/guest
        $materis = Materi::orderBy('id_materi', 'desc')->get();

        return view('pages.home-peserta', compact('announcements', 'materis'));
    }
}
