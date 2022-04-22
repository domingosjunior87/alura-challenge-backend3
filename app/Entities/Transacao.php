<?php

namespace App\Entities;

use DateTimeInterface;

class Transacao
{
    /** @var string */
    public $bancoOrigem;
    /** @var string */
    public $agenciaOrigem;
    /** @var string */
    public $contaOrigem;
    /** @var string */
    public $bancoDestino;
    /** @var string */
    public $agenciaDestino;
    /** @var string */
    public $contaDestino;
    /** @var float */
    public $valor;
    /** @var DateTimeInterface */
    public $dataHora;
}
