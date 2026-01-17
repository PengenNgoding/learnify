<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Materi extends Model
{
    protected $table = 'materi';          // CUKUP 1 TABLE
    protected $primaryKey = 'id_materi';

    protected $fillable = [
        'judul_materi',
        'filename',   // atau nama kolom video lu (misal: 'file_video')
        // kolom lain yang memang ada di tabel 'materi'
    ];

    public function users()
    {
        return $this->belongsToMany(
            'App\User',
            'fasilitas',
            'id_materi',
            'user_id'
        );
    }
}
