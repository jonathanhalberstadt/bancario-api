<?php

namespace Tests\Unit\Repositories;

use App\Models\Conta;
use App\Models\Transacao;
use App\Repositories\TransacaoRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TransacaoRepositoryTest extends TestCase
{
    use RefreshDatabase;

    protected TransacaoRepository $transacaoRepository;

    protected function setUp(): void
    {
        parent::setUp();
        $this->transacaoRepository = new TransacaoRepository();
    }

    public function test_deve_registrar_transacao()
    {
        $conta = Conta::factory()->create(['saldo' => 100.00]);

        $transacao = $this->transacaoRepository->registrarTransacao(
            $conta->numero_conta, 'D', 10.00, 3, 0.30
        );
        
        $this->assertInstanceOf(Transacao::class, $transacao);
        $this->assertEquals($conta->numero_conta, $transacao->numero_conta);
        $this->assertEquals('D', $transacao->forma_pagamento);
        $this->assertEquals(10.00, $transacao->valor);
        $this->assertEquals(0.30, $transacao->taxa_percentual);
        $this->assertEquals(3, $transacao->valor_taxa);
    }
}
