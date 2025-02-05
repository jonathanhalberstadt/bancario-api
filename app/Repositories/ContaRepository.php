<?php

namespace App\Repositories;

use App\Models\Conta;

class ContaRepository
{
    public function criarConta(int $numeroConta, float $saldo)
    {
        // Verifica se a conta já existe
        if ($this->buscarConta($numeroConta)) {
            return ['error' => 'A conta já existe'];
        }

        // Cria a conta caso não exista
        return Conta::create([
            'numero_conta' => $numeroConta,
            'saldo' => $saldo
        ]);
    }

    public function buscarConta(int $numeroConta)
    {
        return Conta::where('numero_conta', $numeroConta)->first();
    }

    public function atualizarConta(Conta $conta)
    {
        return $conta->save();
    }
}
