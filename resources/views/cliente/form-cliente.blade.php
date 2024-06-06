<form action="{{ route('clientes.store') }}" method="post">
    <fieldset>
        <div>
            <label for="">Nome/Razao Social</label>
            <input type="text" name="RazaoSocial" id="">
        </div>
        <div>
            <label for="">Nome Fantasia</label>
            <input type="text" name="NomeFantasia" id="">
        </div>
        <div>
            <label for="">Resposavel</label>
            <input type="text" name="Responsavel" id="">
        </div>
        <div>
            <label for="">Cnpj</label>
            <input type="text" name="Cnpj" id="">
        </div>
        <div>
            <label for="">Inscricao Estadual</label>
            <input type="text" name="IE" id="">
        </div>

        @include('endereco.form-endereco')
        @include('contato.form-contato')
        @csrf
        <input type="submit" value="Salvar" class="btn btn-primary">
    </fieldset>
</form>
