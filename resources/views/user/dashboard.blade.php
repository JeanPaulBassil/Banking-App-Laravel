@php
$user = \App\Models\User::find(session('user_id'));
$username = strtok($user->email, '@');
$accounts = $user->accounts;
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <!-- Logout Button -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Dashboard</h1>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-warning">Logout</button>
            </form>
        </div>

        <!-- Greeting -->
        <h2 class="mb-3">Hello, {{ $username }}!</h2>

        <!-- Accounts Section -->
        <section class="mb-5">
            <h3>Your Bank Accounts</h3>
            @if($accounts->isNotEmpty())
                <ul class="list-group">
                    @foreach($accounts as $account)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Account Number: {{ $account->id }} - Balance: {{ $account->balance }} - Currency: {{ $account->currency }} - Status: {{ $account->status }}
                            <div class="account-actions">
                                <form action="{{ route('account.destroy', $account->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                                @if($account->status == 'Active')
                                    <a href="{{ route('fund.transfer', $account->id) }}" class="btn btn-info btn-sm ml-2">Fund Transfer</a>
                                @else
                                    <button type="button" class="btn btn-secondary btn-sm ml-2" disabled>Fund Transfer</button>
                                @endif
                            </div>
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="text-secondary">You do not have any bank accounts yet.</p>
            @endif
            <a href="{{ route('account.create') }}" class="btn btn-primary mt-3">Add New Account</a>
        </section>

        <!-- Transaction History Section -->
        <section>
            <h3>Transaction History</h3>
            <form action="{{ route('account.transactions') }}" method="GET" class="mb-3">
                <div class="form-group">
                    <select name="filter" class="form-control" onchange="this.form.submit()">
                        <option value="all" {{ request('filter') == 'all' ? 'selected' : '' }}>All</option>
                        <option value="deposit" {{ request('filter') == 'deposit' ? 'selected' : '' }}>Deposit</option>
                        <option value="withdrawal" {{ request('filter') == 'withdrawal' ? 'selected' : '' }}>Withdrawal</option>
                    </select>
                </div>
            </form>

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Type</th>
                        <th>Amount</th>
                        <th>Currency</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($transactions as $transaction)
                        <tr>
                            <td>{{ $transaction->id }}</td>
                            <td>{{ ucfirst($transaction->type) }}</td>
                            <td>{{ $transaction->amount }}</td>
                            <td>{{ $transaction->currency }}</td>
                            <td>{{ $transaction->transaction_date }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="5">No transactions available.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </section>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
</body>
</html>
