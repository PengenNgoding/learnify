<?php

namespace App\Http\Controllers;

use App\Materi;
use App\Fasilitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\MateriPdf;
use App\History;
use App\Transaction;
class PesertaController extends Controller
{
public function __construct()
{
    // history, viewMateri, dan getVidMateri butuh login
    $this->middleware('auth')->only(['viewMateri', 'getVidMateri', 'history']);
}

public function index()
{
    // semua orang lihat semua materi (guest atau login)
    $materis = Materi::all();

    //return view('pages.home-peserta', compact('materis'));
    return view('pages.home-peserta', compact('materis'));
}



  public function viewMateri($id)
{
    $user   = Auth::user();
    $materi = Materi::where('id_materi', $id)->firstOrFail();

    $hasAccess = Transaction::where('user_id', $user->user_id)
        ->where('id_materi', $materi->id_materi)
        ->where('status', 'sukses')
        ->exists();

    $freeUsed = Transaction::where('user_id', $user->user_id)
        ->where('tipe', 'akses_video')
        ->where('is_free', 1)
        ->count();

    return view('pages.materi-detail', compact('materi', 'hasAccess', 'freeUsed'));
}


    public function pdfIndex()
    {
        $materiPdfs = MateriPdf::orderBy('id_materi', 'desc')->get();

        return view('pages.materi-pdf-peserta-index', compact('materiPdfs'));
    }

    // Detail satu materi PDF untuk peserta
    public function pdfShow($id)
{
    $materi = MateriPdf::findOrFail($id);

    // simpan / update history pdf
    History::updateOrCreate(
        [
            'user_id'   => auth()->id(),
            'id_materi' => $id,
            'tipe'      => 'pdf',
        ],
        []
    );

    return view('pages.materi-pdf-peserta-view', compact('materi'));
}


    public function getVidMateri(Request $request, $id)
{
    $user = Auth::user();

    $materi = Materi::where('id_materi', $id)->firstOrFail();
    $path = storage_path('app/materi/' . $materi->filename);

    if (!\Illuminate\Support\Facades\File::exists($path)) {
        abort(404, 'File video tidak ditemukan di storage/app/materi.');
    }

    // ADMIN: bebas akses
    if ($user && $user->user_type === 'admin') {
        return response()->file($path);
    }

    // PESERTA: cek transaksi sukses (atau logika free lu kalau mau)
    $paid = Transaction::where('user_id', $user->user_id)
        ->where('id_materi', $materi->id_materi)
        ->where('status', 'sukses')
        ->exists();

    $freeUsed = Transaction::where('user_id', $user->user_id)
        ->where('tipe', 'akses_video')
        ->where('is_free', 1)
        ->count();

    if (!$paid && $freeUsed >= 2) {
        abort(403, 'Akses gratis habis. Silakan bayar materi ini.');
    }

    return response()->file($path);
}

public function history()
{
    $userId = auth()->id();

    $videoIds = History::where('user_id', $userId)
        ->where('tipe', 'video')
        ->pluck('id_materi');

    $pdfIds = History::where('user_id', $userId)
        ->where('tipe', 'pdf')
        ->pluck('id_materi');

    $materis    = Materi::whereIn('id_materi', $videoIds)->get();
    $materiPdfs = MateriPdf::whereIn('id_materi', $pdfIds)->get();

    return view('pages.history', compact('materis', 'materiPdfs'));
}


}
