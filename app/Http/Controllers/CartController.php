<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $cart = Cart::with('items.product')->firstOrCreate(
            ['user_id' => Auth::id()]
        );

        return view('cart.index', compact('cart'));
    }

    public function add(Request $request, Product $product)
    {
        $cart = Cart::firstOrCreate(
            ['user_id' => Auth::id()]
        );

        $cartItem = $cart->items()->where('product_id', $product->id)->first();

        if ($cartItem) {
            $cartItem->increment('quantity');
        } else {
            $cart->items()->create([
                'product_id' => $product->id,
                'quantity' => 1,
            ]);
        }

        return redirect()->route('cart.index')->with('success', 'Ürün sepete eklendi.');
    }

    public function remove(CartItem $cartItem)
    {
        $cartItem->delete();
        return redirect()->route('cart.index')->with('success', 'Ürün sepetten çıkarıldı.');
    }

    public function clear()
    {
        $cart = Cart::where('user_id', Auth::id())->first();
        if ($cart) {
            $cart->items()->delete();
        }
        return redirect()->route('cart.index')->with('success', 'Sepet temizlendi.');
    }
}