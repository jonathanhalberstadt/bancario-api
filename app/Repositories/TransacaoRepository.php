<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Log;

use App\Models\Transacao;

class TransacaoRepository
{
    public function registrarTransacao(int $numeroConta, string $formaPagamento, float $valor, float $taxa, float $taxaPercentual)
    {
        try {
            return Transacao::create([
                'numero_conta' => $numeroConta,
                'forma_pagamento' => $formaPagamento,
                'valor' => $valor,
                'taxa_percentual' => $taxaPercentual,
                'valor_taxa' => $taxa
            ]);
        } catch (\Exception $e) {
            Log::error("Erro ao registrar transação", [
                'error' => $e->getMessage(),
                'numero_conta' => $numeroConta,
                'forma_pagamento' => $formaPagamento,
                'valor' => $valor,
                'taxa' => $taxa,
                'taxa_percentual' => $taxaPercentual,
            ]);
            throw $e;
        }
    }

}
