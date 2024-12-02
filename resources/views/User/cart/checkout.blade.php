<!-- resources/views/cart/checkout.blade.php -->

<x-app-layout>
    <div class="container mx-auto p-6">
        <h2 class="text-3xl font-semibold text-gray-800 mb-6">Checkout</h2>

        <!-- Table untuk daftar produk di cart -->
        <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-md">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-6 py-4 text-left text-gray-600">Product</th>
                    <th class="px-6 py-4 text-left text-gray-600">Price</th>
                    <th class="px-6 py-4 text-left text-gray-600">Quantity</th>
                    <th class="px-6 py-4 text-left text-gray-600">Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($carts as $cart)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-6 py-4">{{ $cart->product->name }}</td>
                        <td class="px-6 py-4">Rp {{ number_format($cart->product->price, 2) }}</td>
                        <td class="px-6 py-4">{{ $cart->quantity }}</td>
                        <td class="px-6 py-4">Rp {{ number_format($cart->product->price * $cart->quantity, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Total biaya -->
        <h3 class="mt-4 text-xl font-semibold text-gray-800">Total: Rp {{ number_format($total, 2) }}</h3>

        <!-- Tombol checkout -->
        <form action="{{ route('cart.processCheckout') }}" method="POST" class="mt-6">
            @csrf
            <button type="submit" class="w-full py-3 bg-blue-500 text-white font-semibold rounded-lg shadow-lg hover:bg-blue-600 transition-colors">
                Confirm Checkout
            </button>
        </form>
    </div>
</x-app-layout>
