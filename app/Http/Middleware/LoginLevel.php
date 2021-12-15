<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class LoginLevel
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::user()->level != "superAdmin") {
            return redirect()->to('login');
        }
        elseif (Auth::user()->level != "umum") {
            return redirect()->to('login');
        }
        elseif (Auth::user()->level != "keuangan") {
            return redirect()->to('login');
        }
        elseif (Auth::user()->level != "guru") {
            return redirect()->to('login');
        }
        elseif (Auth::user()->level != "siswa") {
            return redirect()->to('login');
        }
        elseif (Auth::user()->level != "tamu") {
            return redirect()->to('login');
        }
        return $next($request);
    }
}
