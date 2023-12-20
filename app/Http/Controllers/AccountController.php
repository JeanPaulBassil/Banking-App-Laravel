<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\ClientOperation; 
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    /**
     * This Shows the Account creation View
     * 
     * @return \Illuminate\View\View
     */
    public function showCreateAccount()
    {
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

        // Log the account creation operation
        ClientOperation::create([
            'user_id' => $userId,
            'operation_type' => 'Account Creation',
            'operation_details' => 'Created a new account with currency ' . $request->currency
        ]);

        return redirect()->route('dashboard')->with('success', 'Account created successfully and is pending approval.');
    }

    /**
     * Deletes a bank account
     * 
     * @param int $accountId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($accountId)
    {
        $userId = session('user_id');
        if (!$userId) {
            return redirect()->route('login')->withErrors(['email' => 'Not Authenticated']);
        }

        $account = Account::where('id', $accountId)->where('user_id', $userId)->first();

        if ($account) {
            $account->delete();

            // Log the account deletion operation
            ClientOperation::create([
                'user_id' => $userId,
                'operation_type' => 'Account Deletion',
                'operation_details' => 'Deleted account with ID: ' . $accountId
            ]);

            return redirect()->route('dashboard')->with('success', 'Account Deleted Successfully');
        } else {
            return redirect()->back()->withErrors(['error' => 'Account not found or access denied.']);
        }
    }


/**
 * Display the transaction history for the logged-in client.
 *
 * @param \Illuminate\Http\Request $request
 * @return \Illuminate\View\View
 */
public function showTransactionHistory(Request $request)
{
    $userId = session('user_id');
    $user = User::find($userId);
    $accounts = $user->accounts;

    $query = Transaction::whereIn('account_id', $accounts->pluck('id'));

    if ($request->filled('filter') && $request->filter !== 'all') {
        $query->where('type', $request->filter);
    }

    $transactions = $query->get();

    return view('user.dashboard', compact('transactions', 'user', 'accounts'));
}


}
