<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Materi;

class Transaction extends Model
{
    protected $table = 'transactions';

    protected $fillable = [
        'user_id',
        'id_materi',
        'tipe',
        'is_free',
        'status',
        'jumlah',
    ];

    // relasi ke user
    public function user()
    {
        // sesuaikan kalau PK user memang 'user_id'
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    // relasi ke materi (INI YANG KURANG)
    public function materi()
    {
        // foreign key di transactions = id_materi
        // primary key di materi = id_materi
        return $this->belongsTo(Materi::class, 'id_materi', 'id_materi');
    }
}
