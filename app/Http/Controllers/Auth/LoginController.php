<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function authenticated(Request $request, $user)
    {

        $user = Auth::user();

        if($user) {
            if($user->hasRole('super-admin')) {
                return redirect('/admin');
            } elseif ($user->hasRole('admin')) {
                return redirect('/admin');
            }
        }

        return redirect('/');
        // // Check if user has 'ADMIN' role
        // if ($user->roles === 'ADMIN') {
        //     // Redirect to admin dashboard
        //     return redirect()->route('dashboard');
        // }

        // // For other roles, redirect to default home page
        // return redirect('/');
    }

    protected function validateLogin(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);
    }

    public function username()
    {
        return 'username';
    }
}
