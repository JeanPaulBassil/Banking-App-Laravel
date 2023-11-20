<?php

namespace app\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ClientOperation;
use App\Models\User;

class AgentController extends Controller
{

    /**
     * Show the agent dashboard.
     *
     * @return \Illuminate\View\View
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
     * @return \Illuminate\View\View
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
     * @return \Illuminate\View\View
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
}
