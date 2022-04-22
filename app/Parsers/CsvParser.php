<?php

namespace App\Parsers;

class CsvParser implements ArquivoParser
{
    public function parser(string $caminhoArquivo): array
    {
        if (($handle = fopen($caminhoArquivo, 'r')) === false) {
            return [];
        }

        $dados = [];

        while (($data = fgetcsv($handle)) !== false) {
            $dados[] = $data;
        }

        fclose($handle);

        return $dados;
    }
}
