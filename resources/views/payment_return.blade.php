<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Status</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="container mt-5 text-center">
        @if($success)
        <div class="alert alert-success">
            <h2>Payment Successful! 🎉</h2>
            <p>Your payment has been processed successfully.</p>
        </div>
        @else
        <div class="alert alert-danger">
            <h2>Payment Failed! ❌</h2>
            <p>Something went wrong. Please try again later.</p>
        </div>
        @endif

        <a href="{{ url('/') }}" class="btn btn-primary mt-3">Go to Home</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>