<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class AdminController extends Controller
{
    public function showProducts()
    {
        $products = Product::all();

        // Mengirim data produk ke view 'admin.index'
        return view('admin.index', compact('products'));
    }
}
