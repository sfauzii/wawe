<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Symfony\Component\HttpFoundation\Response;

class SharedNotifications
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            // Ambil semua notifikasi untuk Recent Activity (10 terbaru)
            $notif = Auth::user()->notifications()->latest()->take(10)->get();

            // Ambil notifikasi yang belum dibaca untuk navbar (4 terbaru)
            $notifications = Auth::user()->unreadNotifications()->latest()->take(4)->get();

            // Bagikan variabel ke semua view
            View::share('notif', $notif);
            View::share('notifications', $notifications);
        }

        return $next($request);
    }
}
