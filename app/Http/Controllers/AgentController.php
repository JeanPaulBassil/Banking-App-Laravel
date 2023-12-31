<?php

namespace app\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ClientOperation;
use App\Models\User;
use App\Models\Account;
use App\Models\Transaction;
class AgentController extends Controller
{

    /**
     * Show the agent dashboard.
     *
     * @return \Illuminate\View\View | \Illuminate\Http\RedirectResponse
     */
    public function showDashboard()
    {
        $userId = session('user_id');
        if (!$userId) {
            return redirect()->route('login')->withErrors(['error' => 'Not authenticated']);
        }

        return view('agent.dashboard');
    }

    /**
     * Show all client operations.
     *
     * @return \Illuminate\View\View | \Illuminate\Http\RedirectResponse
     */
    public function showClientOperations()
    {
        $userId = session('user_id');
        if (!$userId) {
            return redirect()->route('login')->withErrors(['error' => 'Not authenticated']);
        }

        $operations = ClientOperation::all(); // Fetch all operations, adjust as needed
        return view('agent.operations', ['operations' => $operations]); // Pass data without using compact
    }

    /**
     * Show all clients and their accounts.
     *
     * @return \Illuminate\View\View | \Illuminate\Http\RedirectResponse
     */
    public function showClientAccounts()
    {
        $userId = session('user_id');
        if (!$userId) {
            return redirect()->route('login')->withErrors(['error' => 'Not authenticated']);
        }

        $clients = User::where('role', 'client')->with('accounts')->get();
        return view('agent.accounts', ['clients' => $clients]);
    }

    /**
     * Show all transactions with optional filtering.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View | \Illuminate\Http\RedirectResponse
     */
    public function showTransactions(Request $request)
    {
        $query = Transaction::query();
        
        if ($request->filled('type') && $request->type !== 'all') {
            $query->where('type', $request->type);
        }
    
        $transactions = $query->get();
        return view('agent.transactionhistory', ['transactions' => $transactions]);
    }


    /**
     * Lists all the Pending bank accounts
     *
     * @return \Illuminate\View\View | \Illuminate\Http\RedirectResponse
     */

    public function showPendingAccounts()
    {
        $pendingAccounts = Account::where('status', 'Pending')->get();
        return view('agent.pending-accounts', ['pendingAccounts' => $pendingAccounts]);
    }

    /**
     * Accepts a pending account
     *
     * @param int $accountId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function acceptAccount($accountId)
    {
        $account = Account::find($accountId);
        if ($account) {
            $account->status = 'Active';
            $account->save();
            return redirect()->back()->with('success', 'Account accepted successfully.');
        } else {
            return redirect()->back()->withErrors(['error' => 'Account not found.']);
        }
    }

    /**
     * Deletes a pending account
     *
     * @param int $accountId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteAccount($accountId)
    {
        $account = Account::find($accountId);
        if ($account) {
            $account->delete();
            return redirect()->back()->with('success', 'Account deleted successfully.');
        } else {
            return redirect()->back()->withErrors(['error' => 'Account not found.']);
        }
    }

    public function disableAccount($accountId)
    {
        $account = Account::find($accountId);
        if ($account) {
            $account->status = 'Disabled';
            $account->save();
            return redirect()->back()->with('success', 'Account disabled successfully.');
        } else {
            return redirect()->back()->withErrors(['error' => 'Account not found.']);
        }
    }

    public function enableAccount($accountId)
    {
        $account = Account::find($accountId);
        if ($account) {
            $account->status = 'Active';
            $account->save();
            return redirect()->back()->with('success', 'Account enabled successfully.');
        } else {
            return redirect()->back()->withErrors(['error' => 'Account not found.']);
        }
    }

    public function showTransactionForm($accountId)
    {
        $account = Account::find($accountId);
        if (!$account) {
            return redirect()->back()->withErrors(['error' => 'Account not found.']);
        }
        return view('agent.transaction', ['account' => $account]);
    }

    public function performTransaction(Request $request, $accountId)
    {
        $account = Account::find($accountId);
        if (!$account) {
            return redirect()->back()->withErrors(['error' => 'Account not found.']);
        }
    
        $amount = $request->input('amount');
        $transactionType = $request->input('transactionType');
    
        if ($transactionType == 'withdrawal' && $account->balance < $amount) {
            return redirect()->back()->withErrors(['error' => 'Insufficient funds for withdrawal.']);
        }
    
        $oldBalance = $account->balance;
        $account->balance = ($transactionType == 'deposit')
                            ? $account->balance + $amount
                            : $account->balance - $amount;
        $account->save();
    
        // Log the transaction in client_operations
        // Log the transaction in client_operations
    ClientOperation::create([
        'user_id' => $account->user_id, // Use the user_id from the account model
        'operation_type' => ucfirst($transactionType),
        'operation_details' => sprintf(
            "Performed %s of amount %s. Old balance: %s, New balance: %s",
            $transactionType,
            $amount,
            $oldBalance,
            $account->balance
        )
    ]);
    Transaction::create([
        'account_id' => $accountId,
        'type' => $transactionType,
        'amount' => $amount,
        'currency' => $account->currency, // Assuming currency is a field in the Account model
        'transaction_date' => now(), // Or use Carbon::now() if you're using the Carbon library
    ]);
    
        return redirect()->route('agent.accounts')->with('success', 'Transaction successful.');
    
    }
}
