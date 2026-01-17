<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Announcement;
use App\AnnouncementRead;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
    public function reads()
{
    return $this->hasMany(AnnouncementRead::class, 'announcement_id');
}
    /**
     * Bootstrap any application services.
     *
     * @return void
     */

public function boot(): void
{
    View::composer('*', function ($view) {

        $unreadAnnouncementsCount = 0;
        $unreadAnnouncements = collect();
        $readIds = [];

        if (Auth::check()) {

            $user = Auth::user();

            // kalau admin ga usah notif
            if (($user->user_type ?? null) !== 'admin') {

                $userId = $user->user_id; // sesuai app lu

                // list pengumuman aktif buat dropdown (5 terbaru)
                $unreadAnnouncements = Announcement::active()
                    ->latest()
                    ->take(5)
                    ->get();

                // readIds buat styling read/unread
                $readIds = $user->reads()->pluck('announcement_id')->toArray();

                // count unread (yang belum ada relasi read oleh user ini)
                $unreadAnnouncementsCount = Announcement::active()
                    ->whereDoesntHave('reads', function ($q) use ($userId) {
                        $q->where('user_id', $userId);
                    })
                    ->count();
            }
        }

        $view->with('unreadAnnouncementsCount', $unreadAnnouncementsCount);
        $view->with('unreadAnnouncements', $unreadAnnouncements);
        $view->with('readIds', $readIds);
    });
}

}
