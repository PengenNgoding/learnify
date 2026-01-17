<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MateriPdf extends Model
{
    protected $table = 'materi_pdf';      // ini khusus tabel PDF
    protected $primaryKey = 'id_materi';

    protected $fillable = [
        'judul_materi',
        'filename',   // nama file pdf
    ];
}
