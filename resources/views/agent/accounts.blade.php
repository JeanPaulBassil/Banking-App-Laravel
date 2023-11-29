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
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                Account: {{ $account->account_number }} (Balance: {{ $account->balance }}) - Status: {{ $account->status }}
                            </div>
                            <div>
                                <!-- Make Transaction Button -->
                                <a href="{{ route('agent.transaction', $account->id) }}" class="btn btn-primary btn-sm">Make Transaction</a>

                                <!-- Disable/Enable Buttons -->
                                @if($account->status != 'Disabled')
                                    <form action="{{ route('agent.disable', $account->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-warning btn-sm">Disable</button>
                                    </form>
                                @else
                                    <form action="{{ route('agent.enable', $account->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-success btn-sm">Enable</button>
                                    </form>
                                @endif
                            </div>
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
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
