<?php

namespace App\Http\Controllers;

use App\Entities\Transacao;
use App\Entities\TransacaoBuilder;
use App\Http\Requests\UploadFileTransacaoRequest;
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

        $csvParser = new CsvParser();
        $dados = $csvParser->parser($arquivo->getRealPath());

        /** @var Transacao[] $transacoes */
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

        dd($dados, $transacoes);
    }
}
