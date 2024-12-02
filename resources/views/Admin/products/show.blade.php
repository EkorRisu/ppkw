<x-app-layout>
    <x-slot name="header">
        <div class="container mx-auto p-6">
            <h1 class="text-3xl font-semibold text-gray-800 mb-6">Product Detail</h1>

            <!-- Gambar Produk -->
            <div class="mb-6">
                @if ($product->image)
                    <img src="{{ Storage::url($product->image) }}" alt="Product Image" class="w-full max-w-xs mx-auto shadow-lg rounded-lg">
                @else
                    <p class="text-gray-500">No image available</p>
                @endif
            </div>

            <!-- Nama Produk -->
            <div class="mb-4">
                <h2 class="text-2xl font-bold text-gray-800">Name:</h2>
                <p class="text-lg text-gray-700">{{ $product->name }}</p>
            </div>

            <!-- Harga Produk -->
            <div class="mb-4">
                <h2 class="text-2xl font-bold text-gray-800">Price:</h2>
                <p class="text-lg text-green-600">Rp {{ number_format($product->price, 2) }}</p>
            </div>

            <!-- Stok Produk -->
            <div class="mb-4">
                <h2 class="text-2xl font-bold text-gray-800">Stock:</h2>
                <p class="text-lg text-gray-700">{{ $product->stock }}</p>
            </div>

            <!-- Deskripsi Produk -->
            <div class="mb-6">
                <h2 class="text-2xl font-bold text-gray-800">Description:</h2>
                <p class="text-lg text-gray-700">{{ $product->description ?? 'No description available' }}</p>
            </div>

            <!-- Tombol Kembali -->
            <div class="mt-6">
                <a href="{{ route('products.index') }}" class="inline-block px-6 py-2 bg-black text-white font-semibold rounded-lg shadow-md hover:bg-white hover:text-black focus:outline-none focus:ring-2 focus:ring-black">
                    Back to Product List
                </a>
            </div>            
        </div>
    </x-slot>
</x-app-layout>
