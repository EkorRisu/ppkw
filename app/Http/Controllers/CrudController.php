<?php

namespace App\Http\Controllers;

use App\Models\Crud;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CrudController extends Controller
{
    public function index(Request $request)
    {
        // Ambil query pencarian dari input dan pastikan itu adalah string
        $search = (string) $request->query('search', '');

        // Cari produk berdasarkan nama atau deskripsi
        $products = Crud::when($search, function ($query, $search) {
            return $query->where('name', 'like', "%{$search}%")
                ->orWhere('description', 'like', "%{$search}%");
        })->get();

        return view('admin.products.index', compact('products'));
        
    }



    public function create()
    {
        return view('admin.products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        }

        Crud::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'image' => $imagePath,
        ]);

        return redirect()->route('products.index')->with('success', 'Product added successfully.');
    }

    public function show(Crud $product)
    {
        return view('admin.products.show', compact('product'));
    }

    public function edit(Crud $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        // Temukan produk berdasarkan ID
        $product = Crud::findOrFail($id);

        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Update informasi produk
        $product->name = $request->name;
        $product->price = $request->price;
        $product->stock = $request->stock;

        // Proses gambar baru jika ada
        if ($request->hasFile('image')) {
            try {
                // Simpan gambar baru ke storage
                $path = $request->file('image')->store('products', 'public');

                // Hapus gambar lama jika ada
                if ($product->image && Storage::exists($product->image)) {
                    Storage::delete($product->image);
                }

                // Simpan path gambar baru
                $product->image = $path;
            } catch (\Exception $e) {
                // Tangani error jika ada masalah saat upload gambar
                return redirect()->route('products.edit', $product->id)->with('error', 'Failed to upload image.');
            }
        }

        // Simpan perubahan produk
        $product->save();

        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }




    public function destroy(Crud $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
}
