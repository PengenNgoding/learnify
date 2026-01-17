<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class SetLocale
{
    public function handle($request, Closure $next)
    {
       $locale = Session::get('locale');

if (!$locale) {
    $browser = substr(request()->server('HTTP_ACCEPT_LANGUAGE'), 0, 2);
    $locale = in_array($browser, ['id', 'en']) ? $browser : 'id';
    Session::put('locale', $locale);
}

App::setLocale($locale);

        return $next($request);
    }
}
