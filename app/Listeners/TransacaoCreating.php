<?php

namespace App\Listeners;

use App\Events\TransacaoCreating as TransacaoCreatingEvent;

class TransacaoCreating
{
    public function handle(TransacaoCreatingEvent $event)
    {
        foreach ($event->transacao->getAttributes() as $atributo => $valor) {
            if (empty($valor)) {
                throw new \DomainException($atributo . ' deve ser informado');
            }
        }
    }
}
