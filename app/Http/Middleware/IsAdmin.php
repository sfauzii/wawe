<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if (Auth::check()) {
            /** @var App\Models\User **/ 

            $user = Auth::user();
            if($user->hasRole(['super-admin', 'admin'])) {
                return $next($request);
            }

            return abort(403);
        }
        return abort(403);
        // if(Auth::user() && Auth::user()->roles == 'ADMIN') {
        //     return $next($request);
        // }

        // return redirect('/');
    }
}
