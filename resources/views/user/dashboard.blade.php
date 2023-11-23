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
        <!-- Success and Error Messages -->

        <!-- Logout Button -->
        <div class="d-flex justify-content-end mb-3">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-warning">Logout</button>
            </form>
        </div>

        <!-- Greeting and Accounts List -->
        <h1 class="mb-4">Hello, {{ $username }}!</h1>
        <h2 class="mb-3">Your Bank Accounts</h2>

        @if($accounts->isNotEmpty())
            <ul class="list-group mb-4">
                @foreach($accounts as $account)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Account Number: {{ $account->id }} - Balance: {{ $account->balance }} - Currency: {{ $account->currency }} - Status: {{ $account->status }}
                        <div>
                            <form action="{{ route('account.destroy', $account->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                            @if($account->status == 'Active')
                                <a href="{{ route('fund.transfer', $account->id) }}" class="btn btn-info btn-sm ml-2">Fund Transfer</a>
                            @else
                                <button type="button" class="btn btn-info btn-sm ml-2" disabled data-toggle="tooltip" data-placement="top" title="Account is not active. Cannot conduct transfers.">Fund Transfer</button>
                            @endif
                        </div>
                    </li>
                @endforeach
            </ul>
        @else
            <p class="text-secondary">You do not have any bank accounts yet.</p>
        @endif

        <!-- Add New Account Button -->
        <div class="mb-3">
            <a href="{{ route('account.create') }}" class="btn btn-primary">Add New Account</a>
        </div>
    </div>

    <!-- Bootstrap and Tooltip Activation Scripts -->
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

