<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Transaction for Account: {{ $account->account_number }}</h2>

        <form action="{{ route('agent.performTransaction', $account->id) }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="amount">Amount:</label>
                <input type="number" id="amount" name="amount" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="transactionType">Transaction Type:</label>
                <select name="transactionType" id="transactionType" class="form-control" onchange="updateAmountLimit()">
                    <option value="deposit">Deposit</option>
                    <option value="withdrawal">Withdrawal</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="{{ url()->previous() }}" class="btn btn-secondary">Back</a>
        </form>
    </div>

    <script>
        function updateAmountLimit() {
            var transactionType = document.getElementById('transactionType').value;
            var amountInput = document.getElementById('amount');

            if (transactionType === 'withdrawal') {
                amountInput.max = {{ $account->balance }};
            } else {
                amountInput.removeAttribute('max');
            }
        }

        window.onload = updateAmountLimit;
    </script>
</body>
</html>
