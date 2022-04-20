<?php

namespace App\Http\Controllers;

use App\Http\Requests\UploadFileTransacaoRequest;
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
        dd($arquivo);
    }
}
