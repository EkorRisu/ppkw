<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-semibold text-gray-800">Edit Product</h2>
    </x-slot>

    <div class="container mt-8 mx-auto px-6 py-8 bg-white shadow-md rounded-md">
        <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Nama Produk -->
            <div class="mb-6">
                <label for="name" class="block text-gray-700 text-sm font-semibold mb-2">Product Name</label>
                <input type="text" name="name" id="name" class="w-full px-4 py-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500" value="{{ old('name', $product->name) }}" required>
                @error('name')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Harga Produk -->
            <div class="mb-6">
                <label for="price" class="block text-gray-700 text-sm font-semibold mb-2">Price</label>
                <input type="number" name="price" id="price" class="w-full px-4 py-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500" value="{{ old('price', $product->price) }}" required>
                @error('price')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Stok Produk -->
            <div class="mb-6">
                <label for="stock" class="block text-gray-700 text-sm font-semibold mb-2">Stock</label>
                <input type="number" name="stock" id="stock" class="w-full px-4 py-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500" value="{{ old('stock', $product->stock) }}" required>
                @error('stock')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Gambar Produk -->
            <div class="mb-6">
                <label for="image" class="block text-gray-700 text-sm font-semibold mb-2">Product Image</label>
                @if ($product->image)
                    <div class="mb-2">
                        <img src="{{ Storage::url($product->image) }}" alt="Product Image" class="w-32 h-32 object-cover rounded-lg shadow-md">
                    </div>
                @endif
                <input type="file" name="image" id="image" class="w-full px-4 py-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500">
                @error('image')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Tombol Submit -->
            <div class="mb-6">
                <button type="submit" class="w-full py-3 bg-black text-white font-semibold rounded-md hover:bg-white hover:text-black hover:border hover:border-black transition duration-300">
                    Update Product
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
