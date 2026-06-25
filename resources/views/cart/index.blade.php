<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sepetim</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h1>Sepetim</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($cart->items->isEmpty())
        <div class="alert alert-info">Sepetiniz boş. <a href="{{ route('products.index') }}">Alışverişe başla</a></div>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Ürün</th>
                    <th>Fiyat</th>
                    <th>Adet</th>
                    <th>Toplam</th>
                    <th>İşlem</th>
                </tr>
            </thead>
            <tbody>
                @php $genel_toplam = 0; @endphp
                @foreach($cart->items as $item)
                @php $genel_toplam += $item->product->price * $item->quantity; @endphp
                <tr>
                    <td>{{ $item->product->name }}</td>
                    <td>{{ number_format($item->product->price, 2) }} TL</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ number_format($item->product->price * $item->quantity, 2) }} TL</td>
                    <td>
                        <form action="{{ route('cart.remove', $item) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Çıkar</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="3">Genel Toplam</th>
                    <th>{{ number_format($genel_toplam, 2) }} TL</th>
                    <th></th>
                </tr>
            </tfoot>
        </table>

        <div class="d-flex gap-2">
            <form action="{{ route('cart.clear') }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-warning">Sepeti Temizle</button>
            </form>
            <a href="{{ route('products.index') }}" class="btn btn-secondary">Alışverişe Devam Et</a>
            <form action="{{ route('orders.store') }}" method="POST">
    @csrf
    <button type="submit" class="btn btn-success">Sipariş Ver</button>
</form>
        </div>
    @endif
</div>
</body>
</html>