<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AnnouncementRead extends Model
{
    protected $table = 'announcement_reads';

    public $timestamps = false;

    protected $fillable = [
        'announcement_id',
        'user_id',
        'read_at',
    ];

    protected $casts = [
        'read_at' => 'datetime',
    ];

    public function announcement()
    {
        return $this->belongsTo(Announcement::class, 'announcement_id');
    }

    // kalau users PK lu itu user_id (varchar), pake mapping ini
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}
