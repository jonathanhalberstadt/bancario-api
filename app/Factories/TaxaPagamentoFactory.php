<?php

namespace App\Factories;

class TaxaPagamentoFactory
{
    public static function calcularTaxa(string $formaPagamento, float $valor): float
    {
        $taxaDebito = env('TAXA_DEBITO', 0.03);
        $taxaCredito = env('TAXA_CREDITO', 0.05);
        $taxaPix = env('TAXA_PIX', 0.00);

        switch ($formaPagamento) {
            case 'D':
                return $valor * $taxaDebito;
            case 'C':
                return $valor * $taxaCredito;
            case 'P':
                return $valor * $taxaPix;
            default:
                throw new \InvalidArgumentException('Forma de pagamento inválida');
        }
    }
}
