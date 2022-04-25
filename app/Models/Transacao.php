<?php
namespace App\Models;

use App\Events\TransacaoCreating;
use App\Exceptions\ImportacaoRelizadaNaDataException;
use DomainException;
use Illuminate\Database\Eloquent\Model;

class Transacao extends Model
{
    protected $table = 'transacoes';

    protected $fillable = [
        'banco_origem',
        'agencia_origem',
        'conta_origem',
        'banco_destino',
        'agencia_destino',
        'conta_destino',
        'valor',
        'data_hora'
    ];

    protected $dispatchesEvents = [
        'creating' => TransacaoCreating::class,
    ];

    protected function possuiImportacaoNaData($dataImportacao): bool
    {
        return (self::whereRaw('date(data_hora) = ?', [$dataImportacao])->count() > 0);
    }

    /**
     * @param \App\Entities\Transacao[] $transacoes
     * @throws ImportacaoRelizadaNaDataException
     */
    public function importar(array $transacoes): void
    {
        if (count($transacoes) === 0) {
            return;
        }

        $dataImportacao = $transacoes[0]->dataHora->format('Y-m-d');

        if ($this->possuiImportacaoNaData($dataImportacao)) {
            throw new ImportacaoRelizadaNaDataException('Já foi realizada importação desse dia');
        }

        foreach ($transacoes as $transacao) {
            if ($dataImportacao !== $transacao->dataHora->format('Y-m-d')) {
                continue;
            }

            try {
                self::create([
                    'banco_origem' => $transacao->bancoOrigem,
                    'agencia_origem' => $transacao->agenciaOrigem,
                    'conta_origem' => $transacao->contaOrigem,
                    'banco_destino' => $transacao->bancoDestino,
                    'agencia_destino' => $transacao->agenciaDestino,
                    'conta_destino' => $transacao->contaDestino,
                    'valor' => $transacao->valor,
                    'data_hora' => $transacao->dataHora
                ]);
            } catch (DomainException $ex) {
                continue;
            }
        }
    }
}
