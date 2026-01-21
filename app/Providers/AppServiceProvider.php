<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;

use App\Announcement;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        // Optional (kalau MySQL lama / index error)
        // Schema::defaultStringLength(191);

        // FIX: biar asset() / url() gak jadi http pas di Railway proxy
        if (app()->environment('production')) {
            URL::forceScheme('https');
        }

        View::composer('*', function ($view) {

            $unreadAnnouncementsCount = 0;
            $unreadAnnouncements = collect();
            $readIds = [];

            if (Auth::check()) {

                $user = Auth::user();

                // kalau admin ga usah notif
                if (($user->user_type ?? null) !== 'admin') {

                    // pastiin ini bener sesuai kolom PK user lo
                    $userId = $user->user_id;

                    // list pengumuman aktif buat dropdown (5 terbaru)
                    $unreadAnnouncements = Announcement::active()
                        ->latest()
                        ->take(5)
                        ->get();

                    // readIds buat styling read/unread
                    // ini BUTUH relasi reads() di User model
                    $readIds = $user->reads()
                        ->pluck('announcement_id')
                        ->toArray();

                    // count unread
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
