<?php

namespace App\Http\Controllers;

use App\Models\VehicleModel;
use Illuminate\Http\Request;

class VehicleModelController extends Controller
{
    /**
     * Lista todos os modelos de veículos com paginação.
     */
    public function index(Request $request)
    {
        // Define o número de itens por página (padrão 10)
        $perPage = $request->query('per_page', 10);

        // Retorna todos os modelos de veículos com paginação
        $vehicleModels = VehicleModel::paginate($perPage);

        return response()->json($vehicleModels, 200);
    }

    /**
     * Cria um novo modelo de veículo.
     */
    public function store(Request $request)
    {
        // Validação dos dados de entrada
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Cria um novo modelo de veículo
        $vehicleModel = VehicleModel::create($validatedData);

        return response()->json($vehicleModel, 201);
    }

    /**
     * Exibe um modelo de veículo específico pelo ID.
     */
    public function show($id)
    {
        // Busca o modelo de veículo pelo ID
        $vehicleModel = VehicleModel::find($id);

        // Verifica se o modelo de veículo foi encontrado
        if (!$vehicleModel) {
            return response()->json(['message' => 'Vehicle Model not found'], 404);
        }

        return response()->json($vehicleModel, 200);
    }

    /**
     * Atualiza um modelo de veículo específico pelo ID.
     */
    public function update(Request $request, $id)
    {
        // Validação dos dados de entrada
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Busca o modelo de veículo pelo ID
        $vehicleModel = VehicleModel::find($id);

        // Verifica se o modelo de veículo foi encontrado
        if (!$vehicleModel) {
            return response()->json(['message' => 'Vehicle Model not found'], 404);
        }

        // Atualiza os dados do modelo de veículo
        $vehicleModel->update($validatedData);

        return response()->json($vehicleModel, 200);
    }

    /**
     * Deleta um modelo de veículo específico pelo ID.
     */
    public function destroy($id)
    {
        // Busca o modelo de veículo pelo ID
        $vehicleModel = VehicleModel::find($id);

        // Verifica se o modelo de veículo foi encontrado
        if (!$vehicleModel) {
            return response()->json(['message' => 'Vehicle Model not found'], 404);
        }

        // Deleta o modelo de veículo
        $vehicleModel->delete();

        return response()->json(['message' => 'Vehicle Model deleted'], 200);
    }
}
