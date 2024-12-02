<?php

// app/Http/Controllers/CartController.php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Crud;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $carts = Cart::where('user_id', Auth::id())->with('product')->get();
        return view('user.cart.index', compact('carts'));
    }

    public function addToCart(Request $request, $productId)
    {
        $product = Crud::findOrFail($productId);

        $cart = Cart::where('user_id', Auth::id())
            ->where('product_id', $productId)
            ->first();

        if ($cart) {
            $cart->quantity += $request->quantity ?? 1;
            $cart->save();
        } else {
            Cart::create([
                'user_id' => Auth::id(),
                'product_id' => $productId,
                'quantity' => $request->quantity ?? 1,
            ]);
        }

        return redirect()->back()->with('success', 'Product added to cart.');
    }

    public function checkout()
    {
        $carts = Auth::user()->carts()->with('product')->get();
        if ($carts->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        // Total harga
        $total = $carts->sum(function ($cart) {
            return $cart->product->price * $cart->quantity;
        });

        return view('user.cart.checkout', compact('carts', 'total'));
    }

    public function processCheckout()
    {
        $user = Auth::user();
        $carts = $user->carts()->with('product')->get();

        if ($carts->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        // Total biaya
        $total = $carts->sum(function ($item) {
            return $item->quantity * $item->product->price;
        });

        try {
            // Simpan data pesanan ke database
            $order = $user->orders()->create([
                'total_price' => $total,
                'status' => 'pending', // status awal
            ]);

            foreach ($carts as $item) {
                $order->orderDetails()->create([
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->product->price,
                ]);
            }

            // Hapus semua item dari keranjang setelah checkout
            $user->carts()->delete();

            return redirect()->route('products.index')->with('success', 'Checkout successful!');
        } catch (\Exception $e) {
            return redirect()->route('cart.checkout')->with('error', 'An error occurred during checkout: ' . $e->getMessage());
        }
    }


    public function removeFromCart($id)
    {
        $cart = Cart::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $cart->delete();

        return redirect()->back()->with('success', 'Product removed from cart.');
    }
}

