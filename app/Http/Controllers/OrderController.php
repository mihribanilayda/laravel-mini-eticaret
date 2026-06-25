<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
public function index()
{
    $orders = Order::where('user_id', Auth::id())
        ->latest()
        ->paginate(10);

    return view('orders.index', compact('orders'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
public function store(Request $request)
{
    $cart = \App\Models\Cart::with('items.product')
        ->where('user_id', Auth::id())
        ->first();

    if (!$cart || $cart->items->isEmpty()) {
        return redirect()->route('cart.index')->with('error', 'Sepetiniz boş.');
    }

    $total = $cart->items->sum(function ($item) {
        return $item->product->price * $item->quantity;
    });

    $order = \App\Models\Order::create([
        'user_id' => Auth::id(),
        'total' => $total,
        'status' => 'pending',
    ]);

    foreach ($cart->items as $item) {
        \App\Models\OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $item->product_id,
            'quantity' => $item->quantity,
            'price' => $item->product->price,
        ]);

        $item->product->decrement('stock', $item->quantity);
    }

    $cart->items()->delete();

    return redirect()->route('orders.show', $order)->with('success', 'Siparişiniz oluşturuldu!');
}

    /**
     * Display the specified resource.
     */
public function show(Order $order)
{
    $order->load('orderItems.product');
    return view('orders.show', compact('order'));
}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
