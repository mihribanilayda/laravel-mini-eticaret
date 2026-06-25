<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product->name }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <a href="{{ route('products.index') }}" class="btn btn-secondary mb-3">← Geri</a>
    <form action="{{ route('cart.add', $product) }}" method="POST" class="mt-3">
    @csrf
    <button type="submit" class="btn btn-success">Sepete Ekle</button>
</form>s
    <div class="card">
        <div class="card-body">
            <h1 class="card-title">{{ $product->name }}</h1>
            <p class="text-muted">Kategori: {{ $product->category->name }}</p>
            <p>{{ $product->description }}</p>
            <h3>{{ number_format($product->price, 2) }} TL</h3>
            <p>Stok: {{ $product->stock }} adet</p>
        </div>
    </div>
</div>
</body>
</html>