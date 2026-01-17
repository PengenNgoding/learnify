<?php


namespace App\Http\Controllers;

use App\MateriPdf;
use App\History;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class MateriPdfController extends Controller
{
    /**
     * List semua materi PDF.
     */
    public function index()
    {
        $materiPdfs = MateriPdf::orderBy('id_materi', 'desc')->get();

        return view('pages.materi-pdf-index', compact('materiPdfs'));
    }

    /**
     * Form tambah materi PDF (kalau dipakai).
     */
    public function create()
    {
        return view('pages.materi-pdf-create');
    }

    /**
     * Simpan materi PDF baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul_materi' => 'required|string|max:255',
            'file_pdf'     => 'required|mimes:pdf|max:20480', // 20MB
        ]);

        $file = $request->file('file_pdf');
        $filename = time() . '_' . $file->getClientOriginalName();

        // simpan ke storage/app/public/materi_pdf
        $file->storeAs('materi_pdf', $filename, 'public');

        MateriPdf::create([
            'judul_materi' => $request->judul_materi,
            'filename'     => $filename,
        ]);

        return redirect()
            ->route('materi-pdf.index')
            ->with('success', 'Materi PDF berhasil ditambah');
    }

    /**
     * Stream file PDF ke browser (dipakai iframe).
     */
   public function getPdf($id)
{
    $materi = MateriPdf::findOrFail($id);

    // file disimpan di disk 'public', folder materi_pdf
    $path = Storage::disk('public')->path('materi_pdf/' . $materi->filename);

    if (! file_exists($path)) {
        abort(404, 'File PDF tidak ditemukan');
    }

    return response()->file($path);
}

    /**
     * Detail materi PDF (halaman yang ada iframe).
     */
    public function show($id)
{
    // ambil data PDF
    $materiPdf = MateriPdf::findOrFail($id);

    // catat ke tabel history kalau user lagi login
    if (Auth::check()) {
        History::create([
            'user_id'   => Auth::id(),
            'id_materi' => $materiPdf->id_materi,
            'tipe'      => 'pdf',                 
        ]);
    }

    // kirim ke view, sama kayak sebelumnya
    return view('pages.materi-pdf-view', [
        'materi' => $materiPdf,
    ]);
}


    /**
     * Form edit materi PDF.
     */
    public function edit($id)
    {
        $materiPdf = MateriPdf::findOrFail($id);

        return view('pages.materi-pdf-edit', compact('materiPdf'));
    }

    /**
     * Update judul / file PDF.
     */
    public function update(Request $request, $id)
    {
        $materi = MateriPdf::findOrFail($id);

        $request->validate([
            'judul_materi' => 'required|string|max:255',
            'file_pdf'     => 'nullable|mimes:pdf|max:20480',
        ]);

        $materi->judul_materi = $request->judul_materi;

        if ($request->hasFile('file_pdf')) {
            $file = $request->file('file_pdf');
            $filename = time() . '_' . $file->getClientOriginalName();

            $file->storeAs('materi_pdf', $filename, 'public');

            // hapus file lama
            if (! empty($materi->filename)) {
                Storage::disk('public')->delete('materi_pdf/' . $materi->filename);
            }

            $materi->filename = $filename;
        }

        $materi->save();

        return redirect()
            ->route('materi-pdf.index')
            ->with('success', 'Materi PDF berhasil diupdate');
    }

    /**
     * Hapus materi PDF + file fisiknya.
     */
    public function destroy($id)
    {
        $materi = MateriPdf::findOrFail($id);

        if (! empty($materi->filename)) {
            Storage::disk('public')->delete('materi_pdf/' . $materi->filename);
        }

        $materi->delete();

        return redirect()
            ->route('materi-pdf.index')
            ->with('success', 'Materi PDF berhasil dihapus');
    }
}
