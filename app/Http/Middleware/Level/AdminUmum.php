<?php

namespace App\Http\Middleware\Level;

use Closure;

class AdminUmum
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
        if(auth()->user()->level == 'umum'){
            return $next($request);
        }
   
        return redirect('/')->with('error',"Only admin can access!");
    }
}
