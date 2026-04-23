<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return response()->json(Product::with('categories')->get(), 200);
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

        return response()->json(['message' => 'Creado', 'data' => $product->load('categories')], 201);
    }

    public function show(Product $product)
    {
        return response()->json($product->load('categories'), 200);
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

        return response()->json(['message' => 'Actualizado', 'data' => $product->load('categories')], 200);
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return response()->json(['message' => 'Eliminado'], 200);
    }
}
