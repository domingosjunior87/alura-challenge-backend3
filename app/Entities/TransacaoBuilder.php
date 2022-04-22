<?php

namespace App\Entities;

class TransacaoBuilder
{
    /** @var Transacao */
    private $transacao;

    public function __construct()
    {
        $this->transacao = new Transacao();
    }

    public function origem(string $banco, string $agencia, string $conta) : self
    {
        $this->transacao->bancoOrigem = $banco;
        $this->transacao->agenciaOrigem = $agencia;
        $this->transacao->contaOrigem = $conta;

        return $this;
    }

    public function destino(string $banco, string $agencia, string $conta) : self
    {
        $this->transacao->bancoDestino = $banco;
        $this->transacao->agenciaDestino = $agencia;
        $this->transacao->contaDestino = $conta;

        return $this;
    }

    public function comValor(string $valor) : self
    {
        $this->transacao->valor = (float) $valor;

        return $this;
    }

    public function dataHora(string $dataHora) : self
    {
        $this->transacao->dataHora = new \DateTimeImmutable($dataHora);

        return $this;
    }

    public function constroi() : Transacao
    {
        return $this->transacao;
    }
}
