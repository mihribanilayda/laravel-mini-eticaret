<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ürünler</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h1>Ürünler</h1>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>İsim</th>
                <th>Kategori</th>
                <th>Fiyat</th>
                <th>Stok</th>
                <th>Detay</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->category->name }}</td>
                <td>{{ number_format($product->price, 2) }} TL</td>
                <td>{{ $product->stock }}</td>
                <td><a href="{{ route('products.show', $product) }}" class="btn btn-sm btn-primary">Görüntüle</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $products->links() }}
</div>
</body>
</html>