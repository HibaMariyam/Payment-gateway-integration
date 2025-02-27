<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h2 class="mb-4">Order a Product</h2>

        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
        @endif

        <form action="{{ route('order.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="product" class="form-label">Select Product</label>
                <select name="product_id" class="form-control" required>
                    <option value="">-- Choose a Product --</option>
                    @foreach($products as $product)
                    <option value="{{ $product->id }}">
                        {{ $product->name }} - ${{ $product->price }} (Stock: {{ $product->stock }})
                    </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="quantity" class="form-label">Quantity</label>
                <input type="number" name="quantity" class="form-control" required min="1">
            </div>

            <button type="submit" class="btn btn-primary">Place Order</button>
        </form>
    </div>
</body>

</html>