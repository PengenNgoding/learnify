<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PesertaController;
use App\Http\Controllers\MateriController;
use App\Http\Controllers\MateriPdfController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FasilitasController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\PesertaAnnouncementController;

// ===================== LANDING / DASHBOARD UTAMA =====================
Route::get('/', [PesertaController::class, 'index'])->name('home');
Route::redirect('/home', '/');
Route::get('/lang/{locale}', function ($locale) {
    if (!in_array($locale, ['id', 'en'])) abort(404);
    session(['locale' => $locale]);
    return redirect()->back();
})->name('lang.switch');

Route::middleware(['auth'])->group(function () {
    Route::get('/getVidMateri/{id}', [PesertaController::class, 'getVidMateri'])->name('materi.video');
});

// ===================== PESERTA / USER BIASA ==========================
Route::middleware(['auth', 'auth_is_peserta'])->group(function () {
    Route::get('/history', [PesertaController::class, 'history'])->name('history');

    // VIDEO
    Route::get('/view-materi/{id}', [PesertaController::class, 'viewMateri'])->name('view-materi');

    // ANNOUNCEMENTS PESERTA (index + show)
    Route::get('/pengumuman', [PesertaAnnouncementController::class, 'index'])
        ->name('announcements.peserta.index');

    Route::get('/pengumuman/{announcement}', [PesertaAnnouncementController::class, 'show'])
        ->name('announcements.peserta.show');

    // MATERI PDF PESERTA
    Route::get('/materi-pdf-peserta', [PesertaController::class, 'pdfIndex'])->name('materi-pdf.peserta.index');
    Route::get('/materi-pdf-peserta/{id}', [PesertaController::class, 'pdfShow'])->name('materi-pdf.peserta.show');

    // STREAM FILE PDF (iframe)
    Route::get('/getPdfMateri/{id}', [MateriPdfController::class, 'getPdf'])->name('materi-pdf.file');

    // BAYAR / BUKA AKSES 1 MATERI VIDEO
    Route::post('/materi/{id}/pay', [TransactionController::class, 'pay'])->name('materi.pay');
});
// =========================== ADMIN ===================================
Route::middleware(['auth', 'auth_is_admin'])->group(function () {

    // CRUD USER (tanpa create)
    Route::resource('user', UserController::class)->except(['create']);

    // CRUD MATERI VIDEO (tanpa create)
    Route::resource('materi', MateriController::class)->except(['create']);

    // HANDLE UPLOAD VIDEO MATERI
    Route::post('materiUpload', [MateriController::class, 'handleUpload'])->name('materi.handleUpload');
    Route::patch('materiUpload', [MateriController::class, 'handleUpload']);

    // TRACKING PEMBELIAN MATERI VIDEO (view aja)
    Route::get('/fasilitas', [FasilitasController::class, 'index'])->name('fasilitas.index');

    // CRUD ANNOUNCEMENT
    Route::resource('announcements', AnnouncementController::class)
        ->except(['show'])
        ->names([
            'index'   => 'announcements.index',
            'create'  => 'announcements.create',
            'store'   => 'announcements.store',
            'edit'    => 'announcements.edit',
            'update'  => 'announcements.update',
            'destroy' => 'announcements.destroy',
        ]);

    // CRUD MATERI PDF ADMIN
    Route::resource('materi-pdf', MateriPdfController::class);
});

// =========================== AUTH ====================================
Auth::routes([
    'register'         => true,
    'password.request' => false,
]);
