<?php

namespace App\Http\Controllers;

use App\Announcement;
use App\AnnouncementRead;
use Illuminate\Support\Facades\Auth;

class PesertaAnnouncementController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $userId = $user->user_id; // sesuai yang lu pake di transaksi dsb
        $now = now();

        // Ambil pengumuman aktif + sesuai rentang tanggal
        $announcements = Announcement::query()
            ->where('is_active', 1)
            ->where(function ($q) use ($now) {
                $q->whereNull('tanggal_mulai')
                  ->orWhere('tanggal_mulai', '<=', $now);
            })
            ->where(function ($q) use ($now) {
                $q->whereNull('tanggal_selesai')
                  ->orWhere('tanggal_selesai', '>=', $now);
            })
            ->orderByDesc('created_at')
            ->get();

        // daftar id pengumuman yang sudah dibaca user
        $readIds = AnnouncementRead::where('user_id', $userId)
            ->pluck('announcement_id')
            ->toArray();

        return view('pages.announcements-peserta-index', compact('announcements', 'readIds'));
    }

    public function show(Announcement $announcement)
    {
        $userId = Auth::user()->user_id;
        $now = now();

        // Optional tapi bagus: jangan izinin akses pengumuman non-aktif / belum mulai / udah lewat
        if (
            (int) $announcement->is_active !== 1 ||
            (!is_null($announcement->tanggal_mulai) && $announcement->tanggal_mulai > $now) ||
            (!is_null($announcement->tanggal_selesai) && $announcement->tanggal_selesai < $now)
        ) {
            abort(404);
        }

        // tandai sebagai sudah dibaca
        AnnouncementRead::firstOrCreate([
            'user_id' => $userId,
            'announcement_id' => $announcement->id,
        ]);

        // INI PENTING: view dapet variabel $announcement
        return view('pages.announcements-peserta-show', compact('announcement'));
    }
}
