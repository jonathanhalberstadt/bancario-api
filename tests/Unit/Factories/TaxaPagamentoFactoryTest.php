<?php

namespace Tests\Unit\Factories;

use App\Factories\TaxaPagamentoFactory;
use InvalidArgumentException;
use Tests\TestCase;

class TaxaPagamentoFactoryTest extends TestCase
{
    public function test_deve_calcular_taxa_debito()
    {
        $taxa = TaxaPagamentoFactory::calcularTaxa('D', 100.00);
        $this->assertEquals(3.00, $taxa); // 3% de 100
    }

    public function test_deve_calcular_taxa_credito()
    {
        $taxa = TaxaPagamentoFactory::calcularTaxa('C', 200.00);
        $this->assertEquals(10.00, $taxa); // 5% de 200
    }

    public function test_deve_calcular_taxa_pix()
    {
        $taxa = TaxaPagamentoFactory::calcularTaxa('P', 500.00);
        $this->assertEquals(0.00, $taxa); // PIX sem taxa
    }

    public function test_deve_retornar_erro_para_forma_de_pagamento_invalida()
    {
        $this->expectException(InvalidArgumentException::class);
        TaxaPagamentoFactory::calcularTaxa('X', 100.00);
    }
}
