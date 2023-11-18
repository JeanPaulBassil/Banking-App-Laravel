<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;


class Authenticate{

    /**
     * Handles incoming requests
     * 
     * Checks if the user is logged in by verifying the session data
     * 
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */

    public function handle(Request $request, Closure $next){
        if(!$request->session()->has('user_id'))
            return redirect()->route('login');

        return $next($request);
    }
}