<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use App\Models\Transaction;

class UserController extends Controller{
    /**
     * Show the App's Dashboard
     *
     * @return \Illuminate\View\View | \Illuminate\Http\RedirectResponse
     */

     public function showDashboard()
     {
         $userId = Session::get('user_id');
         if (!$userId) {
             return redirect('/login');
         }
 
         $user = User::find($userId);
         if ($user && $user->role == "client") {
             $accounts = $user->accounts;
 
             $query = Transaction::whereIn('account_id', $accounts->pluck('id'));
             $transactions = $query->get();
 
             return view("user.dashboard", compact('user', 'accounts', 'transactions'));
         } else {
             return view("agent.dashboard");
         }
     }
}
