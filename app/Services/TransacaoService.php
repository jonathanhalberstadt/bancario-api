<?php

namespace App\Services;

use App\Repositories\ContaRepository;
use App\Repositories\TransacaoRepository;
use App\Factories\TaxaPagamentoFactory;
use Illuminate\Support\Facades\DB;

class TransacaoService
{
    protected $contaRepository;
    protected $transacaoRepository;

    public function __construct(ContaRepository $contaRepository, TransacaoRepository $transacaoRepository)
    {
        $this->contaRepository = $contaRepository;
        $this->transacaoRepository = $transacaoRepository;
    }

    public function processarTransacao(string $formaPagamento, int $numeroConta, float $valor)
    {
        DB::beginTransaction();

        try {
            
            $conta = $this->contaRepository->buscarConta($numeroConta);
            
            if (!$conta) {
                return response()->json(['message' => 'Conta não encontrada'], 404);
            }

            // Calcular taxa e percentual
            $taxa = TaxaPagamentoFactory::calcularTaxa($formaPagamento, $valor);
            $taxaPercentual = $taxa > 0 ? ($taxa / $valor) * 100 : 0;
            $valorTotal = $valor + $taxa;

            if ($conta->saldo < $valorTotal) {
                return response()->json(['message' => 'Saldo insuficiente'], 404);
            }

            // Atualizar saldo da conta
            $conta->saldo -= $valorTotal;
            $this->contaRepository->atualizarConta($conta);

            // Registrar transação com todos os valores
            $this->transacaoRepository->registrarTransacao($numeroConta, $formaPagamento, $valor, $taxa, $taxaPercentual);

            DB::commit();

            return response()->json([
                'numero_conta' => $conta->numero_conta,
                'saldo'        => $conta->saldo,
                'valor'        => $valor,
                'taxa'         => $taxa,
                'taxa_percentual' => $taxaPercentual
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Erro ao processar transação'], 500);
        }
    }
}
