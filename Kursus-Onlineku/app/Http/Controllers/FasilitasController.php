<?php

namespace App\Http\Controllers;

use App\Transaction;   // <— WAJIB
use App\User;          // kalau dipakai
use App\Materi;        // kalau dipakai

class FasilitasController extends Controller
{
    public function index()
    {
        // history / tracking materi yang sudah dibeli
        $transactions = Transaction::with(['user', 'materi'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('pages.fasilitas', compact('transactions'));
    }
}
