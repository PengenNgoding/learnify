<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    protected $table = 'announcements';

    protected $fillable = [
        'judul',
        'isi',
        'tanggal_mulai',
        'tanggal_selesai',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'tanggal_mulai' => 'datetime',
        'tanggal_selesai' => 'datetime',
    ];

    public function reads()
    {
        return $this->hasMany(AnnouncementRead::class, 'announcement_id');
    }

    public function scopeActive($query)
{
    return $query->where('is_active', 1)
        ->where(function ($q) {
            $q->whereNull('tanggal_mulai')
              ->orWhere('tanggal_mulai', '<=', now());
        })
        ->where(function ($q) {
            $q->whereNull('tanggal_selesai')
              ->orWhere('tanggal_selesai', '>=', now());
        });
}
}
