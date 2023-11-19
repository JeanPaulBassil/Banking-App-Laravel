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

    /**
     * Deletes a bank account
     * 
     * @param int $accountId
     * @return \Illuminate\Http\RedirectResponse
     */

    public function destroy($accountId){
        $userId = session('user_id');
        if(!$userId)
            return redirect()->route('login')->withErrors(['email' => 'Not Authenticated']);

        $account = Account::where('id', $accountId)->where('user_id', $userId)->first();

        if($account){
            $account->delete();
            return redirect()->route('dashboard')->with('success','Account Deleted Successfully');
        } else
            return redirect()->back()->withErrors(['error' => 'Account not found or access denied.']);
    }
    

}