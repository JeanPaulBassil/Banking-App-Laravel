<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Transaction History</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <a href="{{ route('agent.dashboard') }}" class="btn btn-primary mb-3">Back to Dashboard</a>
      
        <!-- Filter Form -->
        <form action="{{ route('agent.transactions') }}" method="get" class="mb-4">
            <div class="form-row align-items-center">
                <div class="col-auto">
                    <label for="type" class="sr-only">Type</label>
                    <select class="form-control mb-2" id="type" name="type">
                        <option value="">Select Type</option>
                        <option value="all">All</option>
                        <option value="deposit">Deposit</option>
                        <option value="withdrawal">Withdrawal</option>
                    </select>
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary mb-2">Filter</button>
                </div>
            </div>
        </form>

        <!-- Transactions Table -->
        <h2 class="mb-4">Transaction History</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Account ID</th>
                    <th>Type</th>
                    <th>Amount</th>
                    <th>Currency</th>
                    <th>Transaction Date</th>
                    <th>Created At</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($transactions as $transaction)
                    <tr>
                        <td>{{ $transaction->id }}</td>
                        <td>{{ $transaction->account_id }}</td>
                        <td>{{ $transaction->type }}</td>
                        <td>{{ $transaction->amount }}</td>
                        <td>{{ $transaction->currency }}</td>
                        <td>{{ $transaction->transaction_date }}</td>
                        <td>{{ $transaction->created_at }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7">No transactions available.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
