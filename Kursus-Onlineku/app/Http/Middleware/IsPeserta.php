<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class IsPeserta
{
    public function handle($request, Closure $next)
    {
        // pastiin sudah login
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // sesuaikan dengan kolom di tabel users kamu
        // tadi kan user_type isinya 'admin' / 'peserta'
        if (Auth::user()->user_type !== 'peserta') {
            // kalau bukan peserta, lempar kemana aja terserah
            return redirect('/')->with('error', 'Akses khusus peserta.');
        }

        return $next($request);
    }
}
