<x-layout>
    <h1>Importar Transações</h1>
    <form method="post" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <input class="form-control" type="file" name="arquivo" id="formFile" aria-describedby="fileHelp">
            <div id="fileHelp" class="form-text">Selecione o arquivo para realizar o upload</div>
        </div>
        <button type="submit" class="btn btn-primary">Importar</button>
    </form>
</x-layout>
