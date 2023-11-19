<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Session;

class CheckClient{
    /**
     * Checks if the user is a client
     * 
     * @param Closure $next
     * @param \Illuminate\Http\Request
     * @return mixed
     */

    public function checkUser($request, Closure $next){
        $user_id = Session::get("user_id");
        if(!$user_id){
            return redirect('/login');
        }

        $user = User::find($user_id);
        if($user && $user->role == 'client')
            return $next($request);
        
        return redirect('/');
    }
}