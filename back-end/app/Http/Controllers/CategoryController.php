<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Lista todas as categorias com paginação.
     */
    public function index(Request $request)
    {
        // Define o número de itens por página (padrão 10)
        $perPage = $request->query('per_page', 10);

        // Retorna todas as categorias com paginação
        $categories = Category::paginate($perPage);

        return response()->json($categories, 200);
    }

    /**
     * Cria uma nova categoria.
     */
    public function store(Request $request)
    {
        // Validação dos dados de entrada
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Cria uma nova categoria
        $category = Category::create($validatedData);

        return response()->json($category, 201);
    }

    /**
     * Exibe uma categoria específica pelo ID.
     */
    public function show($id)
    {
        // Busca a categoria pelo ID
        $category = Category::find($id);

        // Verifica se a categoria foi encontrada
        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);
        }

        return response()->json($category, 200);
    }

    /**
     * Atualiza uma categoria específica pelo ID.
     */
    public function update(Request $request, $id)
    {
        // Validação dos dados de entrada
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Busca a categoria pelo ID
        $category = Category::find($id);

        // Verifica se a categoria foi encontrada
        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);
        }

        // Atualiza os dados da categoria
        $category->update($validatedData);

        return response()->json($category, 200);
    }

    /**
     * Deleta uma categoria específica pelo ID.
     */
    public function destroy($id)
    {
        // Busca a categoria pelo ID
        $category = Category::find($id);

        // Verifica se a categoria foi encontrada
        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);
        }

        // Deleta a categoria
        $category->delete();

        return response()->json(['message' => 'Category deleted'], 200);
    }
}
