<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setores\Armazenagem;

class ArmazenagemController extends Controller
{
    // GET /api/armazenagens
    public function index()
    {
        return response()->json(Armazenagem::all(), 200);
    }

    // POST /api/armazenagens
    public function store(Request $request)
    {
        $validated = $request->validate([
            'sku' => 'required|string|max:100',
            'quantidade' => 'required|integer',
            'endereco' => 'required|string|max:50',
            'observacoes' => 'nullable|string',
            'usuario_id' => 'required|integer',
            'unidade_id' => 'required|integer',
        ]);

        $armazenagem = Armazenagem::create($validated);
        return response()->json($armazenagem, 201);
    }

    // GET /api/armazenagens/{id}
    public function show($id)
    {
        $armazenagem = Armazenagem::find($id);
        if (!$armazenagem) {
            return response()->json(['message' => 'Registro não encontrado'], 404);
        }

        return response()->json($armazenagem, 200);
    }

    // PUT /api/armazenagens/{id}
    public function update(Request $request, $id)
    {
        $armazenagem = Armazenagem::find($id);
        if (!$armazenagem) {
            return response()->json(['message' => 'Registro não encontrado'], 404);
        }

        $armazenagem->update($request->only([
            'sku',
            'quantidade',
            'endereco',
            'observacoes',
            'usuario_id',
            'unidade_id',
        ]));

        return response()->json($armazenagem, 200);
    }

    // DELETE /api/armazenagens/{id}
    public function destroy($id)
    {
        $armazenagem = Armazenagem::find($id);
        if (!$armazenagem) {
            return response()->json(['message' => 'Registro não encontrado'], 404);
        }

        $armazenagem->delete();
        return response()->json(['message' => 'Registro removido com sucesso'], 200);
    }
}
