<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AksesAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(Auth::guard('pegawai')->check() && Auth::guard('pegawai')->user()->level == 'Admin')
        {
            return $next($request);
        }
        
        return redirect('/login-pegawai');
    }
}
