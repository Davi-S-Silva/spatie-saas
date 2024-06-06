<fieldset>
    <div>
        <label for="">Nome</label>
        <input type="text" name="name">
    </div>
    <div>
        <label for="">Apelido</label>
        <input type="text" name="apelido">
    </div>
    <div>
        <label for="">Foto</label>
        <input type="file" name="foto">
    </div>
    <div>
        <label for="">Data Nascimento</label>
        <input type="date" name="data_nascimento">
    </div>
    <div>
        <label for="">Tipo Colaborador</label>
        <select name="tipo_id" id="">
            <option value="">Selecione uma opção</option>
            @foreach ($TipoColaborador as $item)
                <option value="{{ $item->id }}">{{ $item->tipo }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label for="">Função Colaborador</label>
        <select name="funcao_id" id="">
            <option value="">Selecione uma opção</option>
            @foreach ($FuncaoColaborador as $item)
                <option value="{{ $item->id }}">{{ $item->funcao }}</option>
            @endforeach
        </select>
    </div>
    @csrf
    @include('endereco.form-endereco')
    @include('contato.form-contato')
    <x-select-localapoio/>

    <input type="submit" value="Salvar" class="btn btn-primary">
</fieldset>
