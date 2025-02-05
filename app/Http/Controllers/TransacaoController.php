<?php

namespace App\Http\Controllers;

use App\Services\TransacaoService;
use Illuminate\Http\Request;

class TransacaoController extends Controller
{
    protected $transacaoService;

    public function __construct(TransacaoService $transacaoService)
    {
        $this->transacaoService = $transacaoService;
    }

    public function processarTransacao(Request $request)
    {
        $request->validate([
            'forma_pagamento' => 'required|string|in:P,C,D',
            'numero_conta' => 'required|integer',
            'valor' => 'required|numeric|min:0.01',
        ]);

        return $this->transacaoService->processarTransacao(
            $request->forma_pagamento,
            $request->numero_conta,
            $request->valor
        );
    }
}
