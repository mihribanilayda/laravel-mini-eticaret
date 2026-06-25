<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sipariş #{{ $order->id }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <a href="{{ route('orders.index') }}" class="btn btn-secondary mb-3">← Siparişlerim</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <h1>Sipariş #{{ $order->id }}</h1>
    <p class="text-muted">{{ $order->created_at->format('d.m.Y H:i') }}</p>

    <span class="badge bg-{{ $order->status === 'completed' ? 'success' : ($order->status === 'cancelled' ? 'danger' : 'warning') }} mb-3">
        {{ ucfirst($order->status) }}
    </span>

    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>Ürün</th>
                <th>Birim Fiyat</th>
                <th>Adet</th>
                <th>Toplam</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->orderItems as $item)
            <tr>
                <td>{{ $item->product->name }}</td>
                <td>{{ number_format($item->price, 2) }} TL</td>
                <td>{{ $item->quantity }}</td>
                <td>{{ number_format($item->price * $item->quantity, 2) }} TL</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan="3">Genel Toplam</th>
                <th>{{ number_format($order->total, 2) }} TL</th>
            </tr>
        </tfoot>
    </table>
</div>
</body>
</html>