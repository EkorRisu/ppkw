<x-app-layout>
    <x-slot name="header">
        <div class="container mx-auto p-6 bg-white shadow-lg rounded-lg">
            <h1 class="text-2xl font-semibold text-gray-800 mb-6">Add Product</h1>
            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="space-y-6">
                    <div class="form-group">
                        <label for="name" class="block text-gray-700">Name</label>
                        <input type="text" class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" name="name" id="name" required>
                    </div>

                    <div class="form-group">
                        <label for="description" class="block text-gray-700">Description</label>
                        <textarea class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" name="description" id="description" required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="price" class="block text-gray-700">Price</label>
                        <input type="number" class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" name="price" id="price" required>
                    </div>

                    <div class="form-group">
                        <label for="stock" class="block text-gray-700">Stock</label>
                        <input type="number" class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" name="stock" id="stock" required>
                    </div>

                    <div class="form-group">
                        <label for="image" class="block text-gray-700">Image</label>
                        <input type="file" class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" name="image" id="image">
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="w-full py-3 hover:bg-white hover:text-black font-semibold rounded-md border-2 hover:border-black bg-black text-white transition duration-300">
                            Save
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </x-slot>
</x-app-layout>
