<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    /**
     * Lista todas as marcas com paginação.
     */
    public function index(Request $request)
    {
        // Define o número de itens por página (padrão 10)
        $perPage = $request->query('per_page', 10);

        // Retorna todas as marcas com paginação
        $brands = Brand::paginate($perPage);

        return response()->json($brands, 200);
    }

    /**
     * Cria uma nova marca.
     */
    public function store(Request $request)
    {
        // Validação dos dados de entrada
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Cria uma nova marca
        $brand = Brand::create($validatedData);

        return response()->json($brand, 201);
    }

    /**
     * Exibe uma marca específica pelo ID.
     */
    public function show($id)
    {
        // Busca a marca pelo ID
        $brand = Brand::find($id);

        // Verifica se a marca foi encontrada
        if (!$brand) {
            return response()->json(['message' => 'Brand not found'], 404);
        }

        return response()->json($brand, 200);
    }

    /**
     * Atualiza uma marca específica pelo ID.
     */
    public function update(Request $request, $id)
    {
        // Validação dos dados de entrada
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Busca a marca pelo ID
        $brand = Brand::find($id);

        // Verifica se a marca foi encontrada
        if (!$brand) {
            return response()->json(['message' => 'Brand not found'], 404);
        }

        // Atualiza os dados da marca
        $brand->update($validatedData);

        return response()->json($brand, 200);
    }

    /**
     * Deleta uma marca específica pelo ID.
     */
    public function destroy($id)
    {
        // Busca a marca pelo ID
        $brand = Brand::find($id);

        // Verifica se a marca foi encontrada
        if (!$brand) {
            return response()->json(['message' => 'Brand not found'], 404);
        }

        // Deleta a marca
        $brand->delete();

        return response()->json(['message' => 'Brand deleted'], 200);
    }
}
