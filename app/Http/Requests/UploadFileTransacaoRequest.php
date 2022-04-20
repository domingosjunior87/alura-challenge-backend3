<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\UploadedFile;
use Illuminate\Validation\Validator;

class UploadFileTransacaoRequest extends FormRequest
{
    /** @var bool */
    protected $stopOnFirstFailure = true;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'arquivo' => 'required|file',
        ];
    }

    public function withValidator(Validator $validator): void
    {
        $validator->after(function ($validator) {
            /** @var UploadedFile $arquivo */
            $arquivo = $validator->getData()['arquivo'];

            if ($arquivo->getClientOriginalExtension() !== 'csv') {
                $validator->errors()->add('arquivo', 'O arquivo deve ser do tipo csv');
            }
        });
    }

    public function messages(): array
    {
        return [
            'arquivo.required' => 'Arquivo é obrigatório',
            'arquivo.file' => 'Necessário enviar um arquivo',
        ];
    }
}
