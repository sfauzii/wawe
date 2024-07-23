<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SettingController extends Controller
{
    public function index($username, $id) {

        // Pastikan pengguna yang login sesuai dengan username yang diminta
        if (Auth::user()->username !== $username) {
            return redirect()->route('overview', ['username' => Auth::user()->username, 'id' => Auth::id()]);
        }
        
        // Ambil data pengguna berdasarkan username dan id
        $user = User::where('username', $username)->where('id', $id)->firstOrFail();

        return view('pages.users.settings.settings', [
            'user' => $user
        ]);
    }
}
