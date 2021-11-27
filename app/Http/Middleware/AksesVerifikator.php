<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AksesVerifikator
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
        if(Auth::guard('pegawai')->check())
        {
            if(Auth::guard('pegawai')->user()->level == 'Admin')
            {
                return $next($request);
            }
            elseif (Auth::guard('pegawai')->user()->level == 'Verifikator')
            {
                return $next($request);
            }
            
            return redirect('/login-pegawai');
        }
    }
}
