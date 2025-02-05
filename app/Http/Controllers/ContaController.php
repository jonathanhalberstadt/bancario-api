<?php

namespace App\Http\Controllers;

use App\Services\ContaService;
use Illuminate\Http\Request;

class ContaController extends Controller
{
    protected $contaService;

    public function __construct(ContaService $contaService)
    {
        $this->contaService = $contaService;
    }

    public function store(Request $request)
    {
        $request->validate([
            'numero_conta' => 'required|integer',
            'saldo' => 'required|numeric|min:0',
        ]);

        $resultado = $this->contaService->criarConta($request->numero_conta, $request->saldo);

        if ($resultado instanceof \Illuminate\Http\JsonResponse) {
            return $resultado;
        }

        return response()->json($resultado, 201);
    }

    public function show(Request $request)
    {
        $numeroConta = $request->query('numero_conta'); // Usando o parâmetro da query string
        
        if (empty($numeroConta)) {
            return response()->json(['message' => 'Número da conta é necessário'], 400);
        }

        $conta = $this->contaService->buscarConta($numeroConta);

        if (!$conta) {
            return response()->json(['message' => 'Conta não encontrada'], 404);
        }

        return response()->json([
            'numero_conta' => $conta->numero_conta,
            'saldo' => $conta->saldo
        ], 200);
    }
}
