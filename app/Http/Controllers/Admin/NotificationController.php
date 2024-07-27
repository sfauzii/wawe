<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
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
}
