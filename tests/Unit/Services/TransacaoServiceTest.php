<?php

namespace Tests\Unit\Services;

use App\Factories\TaxaPagamentoFactory;
use App\Models\Conta;
use App\Repositories\ContaRepository;
use App\Repositories\TransacaoRepository;
use App\Services\TransacaoService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TransacaoServiceTest extends TestCase
{
    use RefreshDatabase;

    protected TransacaoService $transacaoService;
    protected ContaRepository $contaRepository;
    protected TransacaoRepository $transacaoRepository;

    protected function setUp(): void
    {
        parent::setUp();
        $this->contaRepository = new ContaRepository();
        $this->transacaoRepository = new TransacaoRepository();
        $this->transacaoService = new TransacaoService($this->contaRepository, $this->transacaoRepository);
    }

    public function test_deve_realizar_transacao_debito_com_taxa()
    {
        // Criando uma conta fictícia
        $conta = Conta::factory()->create(['saldo' => 100.00]);

        // Definição dos valores da transação
        $valor = 10.00;
        $formaPagamento = 'D';

        // Chamada do serviço
        $resultado = $this->transacaoService->processarTransacao($formaPagamento, $conta->numero_conta, $valor);

        // Verificações
        $this->assertEquals(201, $resultado->getStatusCode()); // Verifica se o status é 201 (Criado)

        $responseData = json_decode($resultado->getContent(), true);

        $this->assertEquals($conta->numero_conta, $responseData['numero_conta']);
        $this->assertEquals(100 - ($valor + TaxaPagamentoFactory::calcularTaxa($formaPagamento, $valor)), $responseData['saldo']);
        $this->assertEquals($valor, $responseData['valor']);
    }
}
