<?php


namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\Account;
use Illuminate\Http\Request;


class AccountController extends Controller{


    /**
     * This Shows the Account creation View
     * 
     * @return \Illuminate\View\View
     */

    public function showCreateAccount(){
        return view('account.create');
    }

    /**
     * Store a new bank account.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createAccount(Request $request)
    {
        $this->validate($request, [
            'currency' => 'required|in:LBP,USD,EUR'
        ]);

        $userId = session('user_id');
        if (!$userId) {
            return redirect()->route('login')->withErrors(['email' => 'Not authenticated']);
        }

        $account = new Account([
            'user_id' => $userId,
            'currency' => $request->currency,
            'balance' => 0,
            'status' => 'Pending'
        ]);

        $account->save();

        return redirect()->route('dashboard')->with('success', 'Account created successfully and is pending approval.');
    }


    

}