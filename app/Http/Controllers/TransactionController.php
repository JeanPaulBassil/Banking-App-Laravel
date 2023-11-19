<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class TransactionController extends Controller
{
    /**
     * Show the form for creating a new fund transfer.
     *
     * @param  int  $accountId
     * @return \Illuminate\View\View | \Illuminate\Http\RedirectResponse
     */
    public function showTransferForm($accountId)
    {
        $userId = session('user_id');
        if (!$userId) {
            return redirect()->route('login')->withErrors(['Email' => 'Not authenticated']);
        }

        $account = Account::where('id', $accountId)->where('user_id', $userId)->first();

        if (!$account) {
            return redirect()->route('dashboard')->withErrors(['error' => 'Account not found or you do not have permission to access this account']);
        }

        return view('transaction.transfer', ['account' => $account]);
    }


    /**
     * Execute a fund transfer between accounts.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function executeTransfer(Request $request)
    {
        $userId = session('user_id');
        if (!$userId) {
            return redirect()->route('login')->withErrors(['error' => 'Not authenticated']);
        }

        $validated = $request->validate([
            'fromAccount' => 'required|exists:accounts,id',
            'toAccount' => 'required|exists:accounts,id',
            'amount' => 'required|numeric|min:0'
        ]);

        $fromAccount = Account::where('id', $request->fromAccount)->where('user_id', $userId)->first();
        $toAccount = Account::where('id', $request->toAccount)->first();

        if (!$fromAccount || !$toAccount) {
            return redirect()->route('dashboard')->withErrors(['error' => 'One or more accounts not found']);
        }

        if ($fromAccount->currency != $toAccount->currency) {
            return redirect()->route('dashboard')->withErrors(['error' => 'Currency mismatch between accounts']);
        }

        if ($fromAccount->balance < $request->amount) {
            return redirect()->route('dashboard')->withErrors(['error' => 'Insufficient funds']);
        }

        if ($toAccount->status == 'Pending') {
            return redirect()->route('dashboard')->withErrors(['error' => 'Receiving account is not approved']);
        }

        DB::beginTransaction();

        try {
            $fromAccount->balance -= $request->amount;
            $toAccount->balance += $request->amount;

            $fromAccount->save();
            $toAccount->save();

            DB::commit();
            return redirect()->route('dashboard')->with('success', 'Transfer successful');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('dashboard')->withErrors(['error' => 'Transfer failed']);
        }
    }
}
