<fieldset>
    <section>
        <div>
            <label for="">Nome/Razão Social</label>
            <input type="text" name="Name" id="">
        </div>
        <div>
            <label for="">CPF/CNPJ</label>
            <input type="number" name="Doc" id="">
        </div>
        <div>
            <label for="">Especialidade</label>
            <x-select-especialidade />
        </div>
        <div>
            <label for="">Descrição</label>
            <input type="text" name="Descricao" id="">
        </div>
    </section>
    @csrf
    <section>
        @include('endereco.form-endereco')
    </section>
    <section>
        @include('contato.form-contato')
    </section>
    <input type="submit" value="Salvar" class="btn btn-primary">
</fieldset>
