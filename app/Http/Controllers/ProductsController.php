<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;



class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mendapatkan data user yang sedang login
        $user = Auth::user();
        $userRole = Auth::user()->role; // Mendapatkan role user yang sedang login
        $products = Product::all();

        if(!$user) return view("auth.login");

        // dd($products->toArray());
        if($userRole === "admin") {
            return view("admin.index", compact("products"));
        }else {
            return view("home", compact("products"));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //

        return view("admin.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        // dd($request->all());
        // Validasi input data
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'stok' => 'required|integer|min:1',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Menyimpan path gambar jika ada file yang diupload
        $path = null;
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $imagePath = Storage::disk('public')->put('images', $file);

            $path = $file->storeAs(
                'images', // Direktori target di disk 'public'
                $file->getClientOriginalName(), // Nama file asli
                'public' // Disk 'public'
            ); 
        }

        // dd($path);
    
        // Menyimpan data produk ke database
        Product::create([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'gambar' => $path,
        ]);

        // return redirect()->back()->with('success', 'Produk berhasil ditambahkan ke keranjang.');
    
        return redirect()->route('admin')->with('success', 'Produk berhasil ditambahkan!');
        // return dd($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $products = Product::findOrFail($id);
        return view("home", compact("products"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Menampilkan form edit untuk produk
        $product = Product::findOrFail($id); // Mencari produk berdasarkan ID
        return view("admin.edit", compact('product')); // Mengembalikan view edit dengan data produk
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = Product::findOrFail($id); // Mencari produk berdasarkan ID


        // Validasi input jika diperlukan
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'stok' => 'required|integer|min:0', // Pastikan stok adalah integer dan tidak negatif
        ]);

        // Mengupdate atribut produk dengan data dari request
        $product->nama = $validatedData['nama'];
        $product->deskripsi = $validatedData['deskripsi'];
        $product->stok = $validatedData['stok'];
         
        if($product->save()) {
            return redirect()->route('admin')->with('success', 'Barang berhasil diupdate'); // Redirect ke route admin
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        // Find the product by ID and delete it
        $product = Product::find($id);

        // Check if the product exists
        if ($product) {
            $productId = $product->id;
            $productName = $product->nama;

            $product->delete();
            return redirect()->route('admin')->with('success', "Product ID: {$productId} - {$productName} berhasil di hapus!");
        }

        return redirect()->route('admin')->with('error', 'Product not found.');
    }
}
