<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ctlProduct extends Controller
{
    public function index()
    {
        $products = Product::with('categories')->get();
        $categories = Category::all();
        return view('products', compact('products', 'categories'));
    }

    public function create()
    {
        $categories = Category::all();
        $products = Product::with('categories')->get();

        return view('products', compact('categories', 'products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'Name' => 'required|max:255',
            'Price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
        ]);

        $product = Product::create($request->only(['Name', 'Description', 'DescriptionLong', 'Price']));
        $product->categories()->attach($request->category_id);

        return redirect()->route('products.index')->with('success', 'Producto creado');
    }

    public function edit(Product $product)
    {
        $products = Product::with('categories')->get();
        $categories = Category::all();

        return view('products', compact('product', 'products', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'Name' => 'required|max:255',
            'Price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
        ]);

        $product->update($request->only(['Name', 'Description', 'DescriptionLong', 'Price']));
        $product->categories()->sync([$request->category_id]);

        return redirect()->route('products.index')->with('success', 'Producto actualizado');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Producto eliminado con éxito');
    }
}
