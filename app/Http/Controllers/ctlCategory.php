<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class ctlCategory extends Controller
{
    /**
     * Listar todas las categorías.
     */
    public function index()
    {
        return response()->json(Category::all(), 200);
    }

    /**
     * Crear una nueva categoría.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'description' => 'nullable|max:255',
        ]);

        $category = Category::create($validated);
        return response()->json([
            'message' => 'Categoría creada con éxito',
            'data' => $category
        ], 201);
    }

    /**
     * Consultar una categoría por ID.
     */
    public function show(Category $category)
    {
        return response()->json($category, 200);
    }

    /**
     * Actualizar una categoría.
     */
    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'description' => 'nullable|max:255',
        ]);

        $category->update($validated);
        return response()->json([
            'message' => 'Categoría actualizada con éxito',
            'data' => $category
        ], 200);
    }

    /**
     * Eliminar una categoría.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return response()->json([
            'message' => 'Categoría eliminada con éxito'
        ], 200);
    }
}
