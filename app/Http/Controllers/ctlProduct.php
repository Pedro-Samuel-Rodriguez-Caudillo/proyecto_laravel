<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ctlProduct extends Controller
{
    /**
     * Listar todos los productos con sus categorías.
     */
    public function index()
    {
        $products = Product::with('categories')->get();
        return response()->json($products, 200);
    }

    /**
     * Crear un nuevo producto.
     */
    public function store(Request $request)
    {
        $request->validate([
            'Name' => 'required|max:255',
            'Price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
        ]);

        $product = Product::create($request->only(['Name', 'Description', 'DescriptionLong', 'Price']));
        $product->categories()->attach($request->category_id);

        return response()->json([
            'message' => 'Producto creado con éxito',
            'data' => $product->load('categories')
        ], 201);
    }

    /**
     * Consultar un producto por ID.
     */
    public function show(Product $product)
    {
        return response()->json($product->load('categories'), 200);
    }

    /**
     * Actualizar un producto.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'Name' => 'required|max:255',
            'Price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
        ]);

        $product->update($request->only(['Name', 'Description', 'DescriptionLong', 'Price']));
        $product->categories()->sync([$request->category_id]);

        return response()->json([
            'message' => 'Producto actualizado con éxito',
            'data' => $product->load('categories')
        ], 200);
    }

    /**
     * Eliminar un producto.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return response()->json([
            'message' => 'Producto eliminado con éxito'
        ], 200);
    }
}
