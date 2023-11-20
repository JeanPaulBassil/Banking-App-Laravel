<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client Operations</title>
</head>
<body>
    <div class="container mt-5">
        <a href="{{ route('agent.dashboard') }}" class="btn btn-secondary mb-3">Back to Dashboard</a>
        <h2 class="mb-4">Client Operations</h2>
        <div class="list-group">
            @forelse ($operations as $operation)
                <a class="list-group-item list-group-item-action">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">{{ $operation->operation_type }}</h5>
                        <small>Details: {{ $operation->operation_details }}</small>
                    </div>
                </a>
            @empty
                <p>No operations available.</p>
            @endforelse
        </div>
    </div>
</body>
</html>
