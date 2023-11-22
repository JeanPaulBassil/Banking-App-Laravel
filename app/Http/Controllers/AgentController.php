<?php

namespace app\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ClientOperation;
use App\Models\User;
use App\Models\Account;

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

        // Optional: Additional logic to fetch data for the dashboard

        return view('agent.dashboard'); // Return the agent dashboard view
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

        $clients = User::where('role', 'client')->with('accounts')->get(); // Fetch all clients with their accounts, adjust as needed
        return view('agent.accounts', ['clients' => $clients]); // Pass data without using compact
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
     
}
