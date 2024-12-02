<!-- resources/views/cart/index.blade.php -->

<x-app-layout>
    <div class="container mx-auto p-6 bg-gray-200">
        <h2 class="text-3xl font-semibold text-gray-900 mb-6">Your Cart</h2>

        @if(Auth::user()->role === 'admin')
            <!-- Jika pengguna adalah admin, tampilkan pesan bahwa fitur cart tidak tersedia -->
            <p class="text-gray-700">As an admin, you cannot access the cart feature.</p>
        @else
            <!-- Menampilkan cart hanya untuk user biasa -->
            @if($carts->isEmpty())
                <p class="text-gray-700">Your cart is empty.</p>
            @else
                <!-- Tabel Keranjang -->
                <table class="min-w-full bg-white border border-gray-300 rounded-lg shadow-md">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-6 py-4 text-left text-gray-800">Product</th>
                            <th class="px-6 py-4 text-left text-gray-800">Price</th>
                            <th class="px-6 py-4 text-left text-gray-800">Quantity</th>
                            <th class="px-6 py-4 text-left text-gray-800">Total</th>
                            <th class="px-6 py-4 text-left text-gray-800">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($carts as $cart)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="px-6 py-4 text-gray-800">{{ $cart->product->name }}</td>
                                <td class="px-6 py-4 text-gray-800">Rp {{ number_format($cart->product->price, 2) }}</td>
                                <td class="px-6 py-4 text-gray-800">{{ $cart->quantity }}</td>
                                <td class="px-6 py-4 text-gray-800">Rp {{ number_format($cart->product->price * $cart->quantity, 2) }}</td>
                                <td class="px-6 py-4">
                                    <form action="{{ route('cart.remove', $cart->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-4 py-2 bg-gray-700 text-white font-semibold rounded-md hover:bg-gray-600 transition-colors">
                                            Remove
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Tombol Proceed to Checkout -->
                <div class="mt-6 text-right">
                    <a href="{{ route('cart.checkout') }}" class="px-6 py-3 bg-gray-700 text-white font-semibold rounded-lg shadow-md hover:bg-gray-600 transition-colors">
                        Proceed to Checkout
                    </a>
                </div>
            @endif
        @endif
    </div>
</x-app-layout>
