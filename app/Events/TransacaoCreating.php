<?php

namespace App\Events;

use App\Models\Transacao;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TransacaoCreating
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /** @var Transacao */
    public $transacao;

    public function __construct(Transacao $transacao)
    {
        $this->transacao = $transacao;
    }
}
