<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;

class UserController extends Controller{
    /**
     * Show the App's Dashboard
     * 
     * @return \Illuminate\View\View
     */

    public function showDashboard(){
        return view("user.dashboard");
    }
}