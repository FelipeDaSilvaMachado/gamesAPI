<?php

namespace App\Http\Controllers;

use App\Models\Jogos;
use Illuminate\Http\Request;
// use Illuminate\Http\RedirectResponse;
// use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class JogosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $registros = Jogos::all();
        $contador = $registros->count();

        if ($contador > 0) {
            return response()->json([
                'sucess' => true,
                'message' => 'Jogos encrontrados com sucesso!',
                'data' => $registros,
                'total' => $contador,
            ], 200);
        } else {
            return response()->json([
                'sucess' => false,
                'message' => 'Jogos não encontrados!',
            ], 404);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nome' => 'required',
            'genero' => 'required',
            'ano_lancamento' => 'required',
            'censura' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'sucess' => false,
                'message' => 'Registros inválidos',
                'errors' => $validator->errors(),
            ], 400);
        }

        $registros = Jogos::create($request->all());

        if ($registros) {
            return response()->json([
                'sucess' => true,
                'message' => 'Jogos cadastrados com sucesso!',
                'data' => $registros,
            ], 201);
        } else {
            return response()->json([
                'sucess' => false,
                'message' => 'Erro ao cadastrar jogo',
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Jogos $id)
    {
        $registros = Jogos::find($id);

        if ($registros) {
            return response()->json([
                'sucess' => true,
                'message' => 'Jogo localizado com sucesso!',
                'data' => $registros
            ], 200);
        } else {
            return response()->json([
                'sucess' => false,
                'message' => 'Jogo não localizado',
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'nome' => 'required',
            'genero' => 'required',
            'ano_lancamento' => 'required',
            'censura' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'sucess' => false,
                'message' => 'Registro inválido!',
                'data' => $validator->errors(),
            ], 400);
        }

        $dadosBanco = Jogos::find($id);

        if (!$dadosBanco) {
            return response()->json([
                'sucess' => false,
                'message' => 'Jogo não econtrado!',
            ], 404);
        }

        $dadosBanco->nome = $request->nome;
        $dadosBanco->genero = $request->genero;
        $dadosBanco->ano_lancamento = $request->ano_lancamento;
        $dadosBanco->censura = $request->censura;

        if ($dadosBanco->save()) {
            return response()->json([
                'sucess' => true,
                'message' => 'Jogo ' . ($id) . ' atualizado com sucesso',
                'data' => $dadosBanco,
            ], 200);
        } else {
            return response()->json([
                'sucess' => false,
                'message' => 'Erro ao atualizar jogo ' . ($id),
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Jogos $id)
    {
        $registros = Jogos::find($id);

        if (!$registros) {
            return response()->json([
                'sucess' => false,
                'message' => 'Jogo ' . ($id) . ' não encontrado',
            ], 404);
        }
        if ($registros->delete()) {
            return response()->json([
                'sucess' => true,
                'message' => 'Jogo ' . ($id) . ' deletado com sucesso',
            ], 200);
        } else {
            return response()->json([
                'sucess' => false,
                'message' => 'Erro ao deletar o jogo ' . ($id),
            ], 500);
        }
    }
}
