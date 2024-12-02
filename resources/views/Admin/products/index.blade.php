<x-app-layout>
    <x-slot name="header">
        <div class="container mx-auto px-4 py-6">
            <form action="{{ route('products.index') }}" method="GET" class="flex items-center mb-4">
                <input type="text" name="search" placeholder="Search products..." value="{{ request()->query('search') }}" class="form-input w-80 p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500" />
                <button type="submit" class="ml-3 bg-indigo-600 text-white p-2 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    Search
                </button>
            </form>

            <a href="{{ route('products.create') }}" class="inline-block bg-black text-white py-2 px-4 rounded-md mb-4 hover:bg-white hover:text-black focus:outline-none focus:ring-2 hover:shadow-xl">
                Add Product
            </a>

            <div class="overflow-x-auto shadow-lg rounded-lg">
                <table class="min-w-full bg-white table-auto">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="py-2 px-4 text-left text-sm font-semibold text-gray-700">Image</th>
                            <th class="py-2 px-4 text-left text-sm font-semibold text-gray-700">Name</th>
                            <th class="py-2 px-4 text-left text-sm font-semibold text-gray-700">Price</th>
                            <th class="py-2 px-4 text-left text-sm font-semibold text-gray-700">Stock</th>
                            <th class="py-2 px-4 text-left text-sm font-semibold text-gray-700">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr class="border-t hover:bg-gray-50">
                                <!-- Kolom untuk gambar -->
                                <td class="py-3 px-4">
                                    @if ($product->image)
                                        <img src="{{ Storage::url($product->image) }}" alt="Product Image" class="w-12 h-12 object-cover rounded-full">
                                    @else
                                        <p>No image</p>
                                    @endif
                                </td>
                                <!-- Kolom untuk nama produk -->
                                <td class="py-3 px-4 text-sm text-gray-700">{{ $product->name }}</td>
                                <!-- Kolom untuk harga -->
                                <td class="py-3 px-4 text-sm text-gray-700">Rp {{ number_format($product->price, 2) }}</td>
                                <!-- Kolom untuk stok -->
                                <td class="py-3 px-4 text-sm text-gray-700">{{ $product->stock }}</td>
                                <!-- Kolom untuk aksi -->
                                <td class="py-3 px-4 space-x-2">
                                    <a href="{{ route('products.show', $product->id) }}" class="inline-block bg-blue-600 text-white py-1 px-3 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                        View
                                    </a>
                                    <a href="{{ route('products.edit', $product->id) }}" class="inline-block bg-yellow-600 text-white py-1 px-3 rounded-md hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-yellow-500">
                                        Edit
                                    </a>
                                    <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="inline-block bg-red-600 text-white py-1 px-3 rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500">
                                            Delete
                                        </button>
                                        </form>
                                                                    <form action="{{ route('cart.add', $product->id) }}" method="POST">
                                        @csrf

                                    </form>
                                    @if(Auth::user()->role !== 'admin')
                                        <!-- Tombol Tambahkan ke Keranjang hanya untuk user -->
                                        <form action="{{ route('cart.add', $product->id) }}" method="POST" class="inline-block">
                                            @csrf
                                            <input type="hidden" name="quantity" value="1">
                                            <button type="submit" class="bg-blue-500 text-white py-1 px-4 rounded-lg hover:bg-blue-600 transition">Add to Cart</button>
                                        </form>
                                    @else
                                        <!-- Pesan jika admin tidak bisa menambahkan ke keranjang -->
                                        <p class="text-gray-600 mt-2">Admin cannot add products to the cart.</p>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </x-slot>
</x-app-layout>
