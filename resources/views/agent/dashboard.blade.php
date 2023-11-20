<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Agent Dashboard</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Agent Dashboard</h1>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-warning">Logout</button>
            </form>
        </div>

        <!-- List All Clients Operations -->
        <div class="mb-4">
            <h2>Clients' Operations</h2>
            <a href="{{ route('agent.operations') }}" class="btn btn-info">View Operations</a>
        </div>

        <!-- List All Clients and Their Accounts --> 
        <div class="mb-4">
            <h2>Clients and Their Accounts</h2>
            <a href="{{ route('agent.accounts') }}" class="btn btn-info">View Clients and Accounts</a>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
