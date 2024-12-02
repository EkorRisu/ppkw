<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
        
        <br>

        <!-- Tombol dengan Tailwind CSS -->
        <div class="mt-4">
            <a href="{{ route('products.index') }}" 
               class="px-4 py-2 bg-black text-white font-semibold rounded-lg hover:bg-white hover:text-black hover:shadow-xl transition duration-300 ease-in-out">
                Kelola Produk
            </a>
        </div>
    </x-slot>
</x-app-layout>
