<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Fund Transfer</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        @php
        $user = \App\Models\User::find(session('user_id'));
        $username = strtok($user->email, '@');
        @endphp
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4>{{ $username }}</h4>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-warning">Logout</button>
            </form>
        </div>

        <h2 class="mb-3">Fund Transfer</h2>

        <div class="alert alert-info">
            <strong>Current Balance:</strong> {{ $account->balance }} {{ $account->currency }}
        </div>

        <!-- Fund Transfer Form -->
        <form action="{{ route('transaction.execute') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="fromAccount">From Account ID:</label>
                <input type="text" class="form-control" id="fromAccount" name="fromAccount" value="{{ $account->id }}" readonly>
            </div>

            <div class="form-group">
                <label for="toAccount">To Account ID:</label>
                <input type="text" class="form-control" id="toAccount" name="toAccount" required>
            </div>

            <div class="form-group">
                <label for="amount">Amount:</label>
                <input type="number" class="form-control" id="amount" name="amount" required max="{{ $account->balance }}" min='0'>
            </div>

            <button type="submit" class="btn btn-primary">Transfer</button>
            <!-- Updated Cancel button with specific route and confirmation dialog -->
            <a href="{{ route('dashboard') }}" class="btn btn-secondary" onclick="return confirm('Are you sure you want to cancel the transaction?');">Cancel</a>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
