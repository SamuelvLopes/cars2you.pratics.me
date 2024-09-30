<?php

namespace App\Http\Controllers;

use App\Models\Status;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    /**
     * Lista todos os registros de status com paginação.
     */
    public function index(Request $request)
    {
        // Define o número de itens por página (padrão 10)
        $perPage = $request->query('per_page', 10);

        // Retorna todos os status com paginação
        $statuses = Status::paginate($perPage);

        return response()->json($statuses, 200);
    }

    /**
     * Cria um novo registro de status.
     */
    public function store(Request $request)
    {
        // Validação dos dados de entrada
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Cria um novo registro de status
        $status = Status::create($validatedData);

        return response()->json($status, 201);
    }

    /**
     * Exibe um registro de status específico pelo ID.
     */
    public function show($id)
    {
        // Busca o status pelo ID
        $status = Status::find($id);

        // Verifica se o status foi encontrado
        if (!$status) {
            return response()->json(['message' => 'Status not found'], 404);
        }

        return response()->json($status, 200);
    }

    /**
     * Atualiza um registro de status específico pelo ID.
     */
    public function update(Request $request, $id)
    {
        // Validação dos dados de entrada
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Busca o status pelo ID
        $status = Status::find($id);

        // Verifica se o status foi encontrado
        if (!$status) {
            return response()->json(['message' => 'Status not found'], 404);
        }

        // Atualiza os dados do status
        $status->update($validatedData);

        return response()->json($status, 200);
    }

    /**
     * Deleta um registro de status específico pelo ID.
     */
    public function destroy($id)
    {
        // Busca o status pelo ID
        $status = Status::find($id);

        // Verifica se o status foi encontrado
        if (!$status) {
            return response()->json(['message' => 'Status not found'], 404);
        }

        // Deleta o status
        $status->delete();

        return response()->json(['message' => 'Status deleted'], 200);
    }
}
