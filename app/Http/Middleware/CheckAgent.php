<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;
use App\Models\User;

class CheckAgent
{
    /**
     * Checks if the user is an agent
     * 
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */

    public function handle($request, Closure $next){
        $user_id = Session::get('user_id');
        if(!$user_id){
            return redirect('/login');
        }

        $user = User::find('user_id');
        if($user && $user->role == 'agent')
            return $next($request);
        
        return redirect('/');
    }
}
