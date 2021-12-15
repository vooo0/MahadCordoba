<?php

namespace App\Http\Middleware\Level;

use Closure;

class Guru
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
        if(auth()->user()->level == 'guru'){
            return $next($request);
        }
   
        return redirect('/')->with('error',"Only admin can access!");
    }
}
