<?php

namespace App\Parsers;

interface ArquivoParser
{
    public function parser(string $caminhoArquivo) : array;
}
