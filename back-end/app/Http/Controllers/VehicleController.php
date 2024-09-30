<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    /**
     * Lista todos os veículos com paginação.
     */
    public function index(Request $request)
    {
        // Define o número de itens por página (padrão 10)
        $perPage = $request->query('per_page', 10);

        // Retorna todos os veículos com paginação e inclui os relacionamentos
        $vehicles = Vehicle::with(['brand', 'category', 'model', 'status', 'color'])->paginate($perPage);

        return response()->json($vehicles, 200);
    }

    /**
     * Cria um novo veículo.
     */
    public function store(Request $request)
    {
        // Validação dos dados de entrada
        $validatedData = $request->validate([
            'brand_id' => 'required|exists:brands,id',
            'category_id' => 'required|exists:categories,id',
            'model_id' => 'required|exists:vehicle_models,id',
            'status_id' => 'required|exists:status,id',
            'color_id' => 'required|exists:colors,id',
            'manufacture_year' => 'required|integer|min:1886|max:' . date('Y'), // Ano razoável para veículos
            'weight' => 'required|numeric|min:0',
        ]);

        // Cria um novo veículo
        $vehicle = Vehicle::create($validatedData);

        // Retorna o veículo recém-criado com os relacionamentos
        $vehicle->load(['brand', 'category', 'model', 'status', 'colors']);

        return response()->json($vehicle, 201);
    }

    /**
     * Exibe um veículo específico pelo ID.
     */
    public function show($id)
    {
        // Busca o veículo pelo ID e inclui os relacionamentos
        $vehicle = Vehicle::with(['brand', 'category', 'model', 'status', 'colors'])->find($id);

        // Verifica se o veículo foi encontrado
        if (!$vehicle) {
            return response()->json(['message' => 'Vehicle not found'], 404);
        }

        return response()->json($vehicle, 200);
    }

    /**
     * Atualiza um veículo específico pelo ID.
     */
    public function update(Request $request, $id)
    {
        // Validação dos dados de entrada
        $validatedData = $request->validate([
            'brand_id' => 'required|exists:brands,id',
            'category_id' => 'required|exists:categories,id',
            'model_id' => 'required|exists:vehicle_models,id',
            'status_id' => 'required|exists:status,id',
            'color_id' => 'required|exists:colors,id',
            'manufacture_year' => 'required|integer|min:1886|max:' . date('Y'), // Ano razoável para veículos
            'weight' => 'required|numeric|min:0',
        ]);

        // Busca o veículo pelo ID
        $vehicle = Vehicle::find($id);

        // Verifica se o veículo foi encontrado
        if (!$vehicle) {
            return response()->json(['message' => 'Vehicle not found'], 404);
        }

        // Atualiza os dados do veículo
        $vehicle->update($validatedData);

        // Retorna o veículo atualizado com os relacionamentos
        $vehicle->load(['brand', 'category', 'model', 'status', 'colors']);

        return response()->json($vehicle, 200);
    }

    /**
     * Deleta um veículo específico pelo ID.
     */
    public function destroy($id)
    {
        // Busca o veículo pelo ID
        $vehicle = Vehicle::find($id);

        // Verifica se o veículo foi encontrado
        if (!$vehicle) {
            return response()->json(['message' => 'Vehicle not found'], 404);
        }

        // Deleta o veículo
        $vehicle->delete();

        return response()->json(['message' => 'Vehicle deleted'], 200);
    }
}
