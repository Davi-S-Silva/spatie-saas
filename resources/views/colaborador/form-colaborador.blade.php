<fieldset>
    <div>
        <label for="">Nome</label>
        <input type="text" name="name" value="{{ (isset($Colaborador))? $Colaborador->name :'' }}">
    </div>
    <div>
        <label for="">Apelido</label>
        <input type="text" name="apelido" value="{{ (isset($Colaborador))? $Colaborador->apelido :'' }}">
    </div>
    <div>
        <label for="">Foto</label>
        <input type="file" name="foto">
    </div>
    <div>
        <label for="">Data Nascimento</label>
        <input type="date" name="data_nascimento"  value="{{ (isset($Colaborador))? $Colaborador->data_nascimento :'' }}">
    </div>
    <div>
        <label for="">Tipo Colaborador</label>
        <select name="tipo_id" id="">
            <option value="">Selecione uma opção</option>
            @foreach ($TipoColaborador as $item)
                <option value="{{ $item->id }}" {{ (isset($Colaborador) && $Colaborador->tipo_id == $item->id)? 'selected' :'' }}>{{ $item->tipo }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label for="">Função Colaborador</label>
        <select name="funcao_id" id="">
            <option value="">Selecione uma opção</option>
            @foreach ($FuncaoColaborador as $item)
                <option value="{{ $item->id }}" {{ (isset($Colaborador) && $Colaborador->funcao_id == $item->id)? 'selected' :'' }}>{{ $item->funcao }}</option>
            @endforeach
        </select>
    </div>
    @csrf
    @include('endereco.form-endereco')
    @include('contato.form-contato')
    <x-select-localapoio/>


    <input type="submit" value="Salvar" class="btn btn-primary">
</fieldset>
