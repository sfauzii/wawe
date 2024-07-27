<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{

    public function index()
    {
        $user = Auth::user();

        $allNotifications = $user->notifications()->latest()->get();

        return view('pages.admin.notification-all', compact('allNotifications'));
    }

    public function markAsRead($id)
    {
        $user = Auth::user();

        // Temukan notifikasi dengan ID yang diberikan
        $notification = $user->notifications()->find($id);

        if ($notification) {
            // Tandai notifikasi sebagai dibaca
            $notification->markAsRead();
        }

        toast('Notifikasi telah ditandai sebagai dibaca.', 'success');

        return redirect()->back();
    }

    public function markAllAsRead()
    {
        $user = Auth::user();

        // Tandai semua notifikasi sebagai dibaca
        $user->notifications->markAsRead();

        toast('Semua notifikasi telah ditandai sebagai dibaca.', 'success');

        return redirect()->back();
    }
}
