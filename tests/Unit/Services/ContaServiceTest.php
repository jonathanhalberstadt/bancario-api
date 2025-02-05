<?php

namespace Tests\Unit\Services;

use App\Repositories\ContaRepository;
use App\Services\ContaService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ContaServiceTest extends TestCase
{
    use RefreshDatabase;

    protected ContaService $contaService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->contaService = new ContaService(new ContaRepository());
    }

    public function test_deve_criar_conta_nova()
    {
        $conta = $this->contaService->criarConta(234, 100.00);
        
        $this->assertEquals(234, $conta->numero_conta);
        $this->assertEquals(100.00, $conta->saldo);
    }
}
