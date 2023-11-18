<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RedirectIfAuthenticated
{

    /**
     * Handle an incoming request.
     * 
     * Redirects the user if they are already authenticated
     * 
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */

    public function handle(Request $request, Closure $next){
        if($request->session()->has('user_id')){
            return redirect('/');
        }

        return $next($request);
    }
}
