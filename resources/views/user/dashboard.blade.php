<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <!-- Logout Button -->
        <div class="d-flex justify-content-end">
            <form method="POST" action="{{ route('logout') }}" class="mb-3">
                @csrf
                <button type="submit" class="btn btn-warning">Logout</button>
            </form>
        </div>

        @php
        $user = \App\Models\User::find(session('user_id'));
        $username = strtok($user->email, '@');
        $accounts = $user->accounts;
        @endphp

        <h1 class="mb-4">Hello, {{ $username }}!</h1>
        <h2 class="mb-3">Your Bank Accounts</h2>
        
        {{-- Display user's bank accounts --}}
        @if($accounts->isNotEmpty())
            <ul class="list-group mb-4">
                @foreach($accounts as $account)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Account Number: {{ $account->number }} - Balance: {{ $account->balance }}
                        <form action="{{ route('account.destroy', $account->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </li>
                @endforeach
            </ul>
        @else
            <p class="text-secondary">You do not have any bank accounts yet.</p>
        @endif

        {{-- Link to create a new bank account --}}
        <a href="{{ route('account.create') }}" class="btn btn-primary">Add New Account</a>
    </div>

    <!-- Include Bootstrap JS and its dependencies (if you are using Bootstrap components that require JavaScript) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
