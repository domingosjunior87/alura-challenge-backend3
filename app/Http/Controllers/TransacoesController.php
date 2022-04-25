<?php

namespace App\Http\Controllers;

use App\Entities\Transacao as TransacaoEntity;
use App\Entities\TransacaoBuilder;
use App\Exceptions\ImportacaoRelizadaNaDataException;
use App\Http\Requests\UploadFileTransacaoRequest;
use App\Models\Transacao;
use App\Parsers\CsvParser;
use Illuminate\Http\UploadedFile;

class TransacoesController extends Controller
{
    public function importar()
    {
        return view('transacoes.importar');
    }

    public function store(UploadFileTransacaoRequest $request)
    {
        /** @var UploadedFile $arquivo */
        $arquivo = $request->file('arquivo');

        if ($arquivo->getSize() === 0) {
            return redirect()
                ->route('importar')
                ->withError('Arquivo vazio');
        }

        $csvParser = new CsvParser();
        $dados = $csvParser->parser($arquivo->getRealPath());

        /** @var TransacaoEntity[] $transacoes */
        $transacoes = [];

        foreach ($dados as $dado) {
            $transacaoConstrutor = new TransacaoBuilder();
            $transacoes[] = $transacaoConstrutor
                ->origem($dado[0], $dado[1], $dado[2])
                ->destino($dado[3], $dado[4], $dado[5])
                ->comValor($dado[6])
                ->dataHora($dado[7])
                ->constroi();
        }

        $transacao = new Transacao();

        try {
            $transacao->importar($transacoes);
        } catch (ImportacaoRelizadaNaDataException $e) {
            return redirect()
                ->route('importar')
                ->withError($e->getMessage());
        }

        return redirect()
            ->route('importar')
            ->withSuccess('Importação efetuada!');
    }
}
