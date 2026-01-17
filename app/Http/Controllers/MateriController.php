<?php

namespace App\Http\Controllers;

use App\Materi;
use App\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class MateriController extends Controller
{
    public function __construct()
    {
        // Ini kayaknya area admin, biarin aja
        $this->middleware('auth_is_admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $materis = Materi::all();
        return view('pages.materi', compact('materis'));
    }

    public function index_pdf()
    {
        $materi = Materi::all();
        return view('pages.materi', compact('materi'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul_materi' => 'required|string|max:191',
            'filename'     => 'required|string|max:191'
        ]);

        Materi::create($request->all());

        return redirect('materi')->with('success', 'Materi berhasil diupload.');
    }

    public function handleUpload(Request $request)
    {
        $request->validate([
            'video' => 'required|max:76800'
        ]);

        $filename = time() . '_' . uniqid() . '.' . $request->video->extension();

        if ($request->video->storeAs('materi', $filename)) {
            return response()->json(['status' => 'success', 'filename' => $filename], 200);
        } else {
            return response()->json(['status' => 'failed'], 200);
        }
    }

    /**
     * Display the specified resource (detail materi / video).
     * Di sini kita pasang aturan:
     * - Admin: bebas akses
     * - Peserta: maksimal 2 video gratis / akun
     */
   public function show(Materi $materi)
{
    $user = Auth::user();

    $hasAccess = false;
    $freeUsed  = 0;

    if ($user) {
        $freeUsed = Transaction::where('user_id', $user->user_id)
            ->where('tipe', 'akses_video')
            ->where('is_free', 1)
            ->count();

        $paid = Transaction::where('user_id', $user->user_id)
            ->where('id_materi', $materi->id_materi)
            ->where('status', 'sukses')
            ->exists();

        if ($paid || $freeUsed < 2) {
            $hasAccess = true;
        }
    }

    return view('pages.materi-detail', [
        'materi'    => $materi,
        'hasAccess' => $hasAccess,
        'freeUsed'  => $freeUsed,
    ]);
}

    public function edit(Materi $materi)
    {
        return view('pages.materi-edit', compact('materi'));
    }

    public function update(Request $request, Materi $materi)
    {
        $request->validate([
            'judul_materi' => 'required|string|max:191'
        ]);

        if ($request->filled('filename')) {
            File::delete(storage_path('app/materi/' . $request->old_filename));
            $data = $request->all();
        } else {
            $data = $request->except('filename');
        }

        $materi->update($data);

        return redirect('materi')->with('success', 'Materi berhasil diubah.');
    }

    public function destroy(Materi $materi)
    {
        if ($materi->delete()) {
            File::delete(storage_path('app/materi/' . $materi->filename));

            return redirect('materi')->with('success', 'Materi berhasil dihapus');
        } else {
            return redirect('materi')->with('failed', 'Materi gagal dihapus');
        }
    }
}
