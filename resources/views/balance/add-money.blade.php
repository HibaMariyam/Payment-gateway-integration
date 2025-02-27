<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Money</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="container mt-5">
        <h2>Add Money to Your Account</h2>

        <!-- Success Message (Replace with backend logic) -->
        <div class="alert alert-success" style="display: none;">
            Money added successfully!
        </div>

        <form action="#" method="POST"> <!-- Replace '#' with your backend endpoint -->
            @csrf
            <div class="mb-3">
                <label for="amount" class="form-label">Enter Amount</label>
                <input type="number" name="amount" class="form-control" required min="1">
            </div>
            <button type="submit" class="btn btn-primary">Add Money</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>