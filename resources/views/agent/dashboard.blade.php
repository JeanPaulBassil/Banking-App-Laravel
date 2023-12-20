<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Agent Dashboard</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-5">
            <h1 class="text-primary"><i class="fas fa-user-tie"></i> Agent Dashboard</h1>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-danger"><i class="fas fa-sign-out-alt"></i> Logout</button>
            </form>
        </div>

        <div class="row">
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card bg-info text-white">
                    <div class="card-body">
                        <h5 class="card-title">Clients' Operations</h5>
                        <p class="card-text">Manage and view all client operations</p>
                        <a href="{{ route('agent.operations') }}" class="btn btn-light">View Operations <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card bg-success text-white">
                    <div class="card-body">
                        <h5 class="card-title">Clients and Their Accounts</h5>
                        <p class="card-text">Access and manage client accounts</p>
                        <a href="{{ route('agent.accounts') }}" class="btn btn-light">View Accounts <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card bg-warning">
                    <div class="card-body">
                        <h5 class="card-title">Pending Accounts</h5>
                        <p class="card-text">Review and approve pending accounts</p>
                        <a href="{{ route('agent.pending') }}" class="btn btn-dark">View Pending <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>

            <div class="col-12 mb-4">
                <div class="card border-primary">
                    <div class="card-body">
                        <h5 class="card-title">Transaction History</h5>
                        <p class="card-text">Review the transaction history</p>
                        <a href="{{ route('agent.transactions') }}" class="btn btn-primary">View Transactions <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
