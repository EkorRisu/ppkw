<?php

// app/Http/Controllers/ProductController.php

namespace App\Http\Controllers;

use App\Models\Crud;
use App\Models\Product;

class ProductController extends Controller
{
    // Method untuk menampilkan daftar produk
    public function index()
    {
        // Mengambil semua data produk
        $products = Crud::all();

        // Mengirim data produk ke view
        return view('dashboard', compact('products'));
    }
}
