<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use App\Models\User;
class UserController extends Controller{
    /**
     * Show the App's Dashboard
     * 
     * @return \Illuminate\View\View
     */

    public function showDashboard(){
        $user_id = Session::get('user_id');
        if(!$user_id){
            return redirect('/login');
        }
        $user = User::find($user_id); // Correctly fetch the user using the user_id variable
        if ($user && $user->role == "client"){
            return view("user.dashboard");
        }
        else {
            return view("agent.dashboard");
        }
    }
}