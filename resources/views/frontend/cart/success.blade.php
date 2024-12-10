<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Success</title>
    <style>
        body {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
        }
        .success-message {
            text-align: center;
            padding: 20px;
            background: #28a745;
            color: #fff;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .details {
            text-align: center;
            font-size: 1.2em;
        }
    </style>
</head>
<body>
    <div class="success-message">
        <h1>Payment Successful!</h1>
    </div>
    <div class="details">
        <p>Amount Paid: <strong>{{ $amount }}</strong></p>
        <p>Transaction ID: <strong>{{ $transaction_id }}</strong></p>
        <p>You will be redirected to the homepage in <span id="countdown">5</span> seconds.</p>
    </div>

    <script>
        let countdown = 5;
        const countdownElement = document.getElementById('countdown');

        const timer = setInterval(() => {
            countdown--;
            countdownElement.textContent = countdown;

            if (countdown <= 0) {
                clearInterval(timer);
                window.location.href = "{{ route('home') }}";
            }
        }, 1000);
    </script>
</body>
</html>
