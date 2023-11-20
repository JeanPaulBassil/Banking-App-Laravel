<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client Operations</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .operation-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
            border: 1px solid #ddd;
            margin-bottom: 10px;
            border-radius: 5px;
        }
        .operation-item h5 {
            margin-bottom: 0;
        }
        .operation-item small {
            color: #666;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <a href="{{ route('agent.dashboard') }}" class="btn btn-primary mb-3">Back to Dashboard</a>
        <h2 class="mb-4">Client Operations</h2>
        <div>
            @forelse ($operations as $operation)
                <div class="operation-item">
                    <h5>{{ $operation->operation_type }}</h5>
                    <small>Details: {{ $operation->operation_details }}</small>
                </div>
            @empty
                <p>No operations available.</p>
            @endforelse
        </div>
    </div>
</body>
</html>
