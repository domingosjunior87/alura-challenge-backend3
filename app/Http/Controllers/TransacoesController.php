<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TransacoesController extends Controller
{
    public function importar()
    {
        return view('transacoes.importar');
    }

    public function store(Request $request)
    {
        /** @var \Illuminate\Http\UploadedFile $arquivo */
        $arquivo = $request->file('arquivo');
        dd($arquivo->getClientOriginalName(), $arquivo->getSize());
    }
}
