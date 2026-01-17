<?php

namespace App\Http\Controllers;

use App\Announcement;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    public function index()
    {
        $announcements = Announcement::latest()->get();
        return view('pages.announcements-index', compact('announcements'));
    }

    public function create()
    {
        return view('pages.announcements-create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'judul'           => 'required|string|max:255',
            'isi'             => 'required|string',
            'tanggal_mulai'   => 'nullable|date',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
            'is_active'       => 'nullable|boolean',
        ]);

        // checkbox kadang ga ngirim value
        $data['is_active'] = $request->has('is_active') ? (int) $request->is_active : 0;

        Announcement::create($data);

        return redirect()->route('announcements.index')
            ->with('success', 'Pengumuman berhasil dibuat.');
    }

    public function edit(Announcement $announcement)
    {
        return view('pages.announcements-edit', compact('announcement'));
    }

    public function update(Request $request, Announcement $announcement)
    {
        $data = $request->validate([
            'judul'           => 'required|string|max:255',
            'isi'             => 'required|string',
            'tanggal_mulai'   => 'nullable|date',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
            'is_active'       => 'nullable|boolean',
        ]);

        $data['is_active'] = $request->has('is_active') ? (int) $request->is_active : 0;

        $announcement->update($data);

        return redirect()->route('announcements.index')
            ->with('success', 'Pengumuman berhasil diupdate.');
    }

    public function destroy(Announcement $announcement)
    {
        $announcement->delete();

        return redirect()->route('announcements.index')
            ->with('success', 'Pengumuman berhasil dihapus.');
    }
}
