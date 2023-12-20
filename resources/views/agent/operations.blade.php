<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client Operations</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Arial', sans-serif;
        }
        .container {
            padding-top: 40px;
            padding-bottom: 40px;
        }
        .operation-item {
            background-color: white;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 15px;
            transition: all 0.3s ease;
        }
        .operation-item:hover {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
            transform: translateY(-2px);
        }
        .operation-item h5 {
            color: #007bff;
            margin-bottom: 5px;
        }
        .operation-item small {
            color: #6c757d;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="{{ route('agent.dashboard') }}" class="btn btn-primary mb-4">Back to Dashboard</a>
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

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
