<?php

namespace App\Services;

use App\Repositories\ContaRepository;

class ContaService
{
    protected $contaRepository;

    public function __construct(ContaRepository $contaRepository)
    {
        $this->contaRepository = $contaRepository;
    }

    public function criarConta(int $numeroConta, float $saldo)
    {
        $contaExistente = $this->contaRepository->buscarConta($numeroConta);

        if ($contaExistente) {
            return ['message' => 'Conta já existe'];
        }

        return $this->contaRepository->criarConta($numeroConta, $saldo);
    }

    public function buscarConta(int $numeroConta)
    {
        return $this->contaRepository->buscarConta($numeroConta);
    }
}
