<?php

namespace Tests\Unit\Repositories;

use App\Models\Conta;
use App\Repositories\ContaRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ContaRepositoryTest extends TestCase
{
    use RefreshDatabase;

    protected ContaRepository $contaRepository;

    protected function setUp(): void
    {
        parent::setUp();
        $this->contaRepository = new ContaRepository();
    }

    public function test_deve_criar_uma_conta_nova()
    {
        $result = $this->contaRepository->criarConta(234, 100.00);
        
        $this->assertInstanceOf(Conta::class, $result);
        $this->assertEquals(234, $result->numero_conta);
        $this->assertEquals(100.00, $result->saldo);
        $this->assertNotNull($result->created_at);
    }

    public function test_deve_retornar_erro_quando_conta_ja_existir()
    {
        $this->contaRepository->criarConta(234, 100.00);
        $result = $this->contaRepository->criarConta(234, 200.00);

        $this->assertArrayHasKey('error', $result);
        $this->assertEquals('A conta já existe', $result['error']);
    }

    public function test_deve_buscar_conta_existente()
    {
        $this->contaRepository->criarConta(234, 100.00);
        $conta = $this->contaRepository->buscarConta(234);

        $this->assertInstanceOf(Conta::class, $conta);
        $this->assertEquals(234, $conta->numero_conta);
    }

    public function test_deve_atualizar_conta()
    {
        $conta = $this->contaRepository->criarConta(234, 100.00);
        $conta->saldo = 200.00;

        $this->contaRepository->atualizarConta($conta);
        $updatedConta = $this->contaRepository->buscarConta(234);

        $this->assertEquals(200.00, $updatedConta->saldo);
    }
}
