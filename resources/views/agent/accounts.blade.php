<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clients and Their Accounts</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <a href="{{ route('agent.dashboard') }}" class="btn btn-primary mb-3">Back to Dashboard</a>
        <h2 class="mb-4">Clients and Their Accounts</h2>
        @forelse ($clients as $client)
            <div class="card mb-3">
                <div class="card-header">
                    Client ID: {{ $client->id }} - {{ $client->name }}
                </div>
                <ul class="list-group list-group-flush">
                    @forelse ($client->accounts as $account)
                        <li class="list-group-item">
                            Account: {{ $account->account_number }} (Balance: {{ $account->balance }})
                        </li>
                    @empty
                        <li class="list-group-item">No accounts available for this client.</li>
                    @endforelse
                </ul>
            </div>
        @empty
            <p>No clients or accounts available.</p>
        @endforelse
    </div>
</body>
</html>
