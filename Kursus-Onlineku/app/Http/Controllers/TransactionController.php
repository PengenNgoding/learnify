<?php

namespace App\Http\Controllers;

use App\Transaction;          // <- MODEL, WAJIB di-import
use App\Materi;            // <- karena transaksi ke materi
use App\History;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    // daftar semua transaksi (kalau mau dipakai)
    public function index()
    {
        $transactions = Transaction::with('materi_video', 'user')->latest()->get();

        return view('pages.transactions.index', compact('transactions'));
    }

    // PROSES BAYAR / AKSES MATERI
      public function pay(Request $request, $id)
{
    $user   = Auth::user();                         // user login
    $materi = Materi::where('id_materi', $id)->firstOrFail();

    $harga = 10000; // Rp10.000
    $mode  = $request->input('mode'); // 'free' atau 'paid'

    if ($mode === 'free') {
        // cek sudah pakai berapa kuota free
        $freeUsed = Transaction::where('user_id', $user->user_id)
            ->where('tipe', 'akses_video')
            ->where('is_free', 1)
            ->count();

        if ($freeUsed >= 2) {
            return back()->with('payment_error', 'Kuota gratis kamu sudah habis.');
        }

        // simpan transaksi FREE
        Transaction::create([
            'user_id'   => $user->user_id,          // perhatikan: user_id, BUKAN id
            'id_materi' => $materi->id_materi,
            'tipe'      => 'akses_video',
            'is_free'   => 1,
            'status'    => 'sukses',
            'jumlah'    => 0,
        ]);

    } else { // mode paid
        $amount = (int) $request->input('amount');

        if ($amount < $harga) {
            return back()->with('payment_error', __('messages.payment_min', ['min' => number_format($harga, 0, ',', '.')]));
        }

        // simpan transaksi BERBAYAR
        Transaction::create([
            'user_id'   => $user->user_id,
            'id_materi' => $materi->id_materi,
            'tipe'      => 'akses_video',
            'is_free'   => 0,
            'status'    => 'sukses',
            'jumlah'    => $amount,
        ]);
    }

    // ===========================
    //  TULIS HISTORY DI SINI
    // ===========================
    History::firstOrCreate(
        [
            'user_id'   => $user->user_id,
            'id_materi' => $materi->id_materi,
            'tipe'      => 'video',        // bebas mau 'video' / 'materi' / dll, asal konsisten sama view
        ]
    );

    // balik lagi ke halaman view materi
    return redirect()->route('view-materi', $materi->id_materi)
    ->with('success', 'Akses materi berhasil dibuka.');
}

    // sisanya biarin kosong dulu, TANPA type hint apa pun
    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate([
        'materi_pdf_id' => 'required|exists:materi_pdfs,id',
    ]);

    Transaction::create([
        'user_id'        => auth()->id(),
        'materi_pdf_id'  => $request->materi_pdf_id,
        'tipe'           => 'pembelian',
        'status'         => 'sukses',   // kalau belum ada payment gateway, anggap langsung sukses
        'jumlah'         => 0,
    ]);

    return redirect()->back()->with('success', 'Transaksi berhasil, materi masuk ke history kamu.');

    }

    public function show(Transaction $transaction)
    {
        //
    }

    public function edit(Transaction $transaction)
    {
        //
    }

    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    public function destroy(Transaction $transaction)
    {
        //
    }
}
