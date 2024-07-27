<fieldset>
    <section class="col-12">
        <div class="d-flex col-12 justify-between">
            <div class="col-5 d-flex flex-column">
                <label for="">Nome</label>
                <input type="text" name="name" value="{{ (isset($Colaborador))? $Colaborador->name :'' }}">
            </div>
            <div class="col-5 d-flex flex-column">
                <label for="">Apelido</label>
                <input type="text" name="apelido" value="{{ (isset($Colaborador))? $Colaborador->apelido :'' }}">
            </div>
        </div>
        <div class="d-flex col-12 justify-between my-3">
            <div class="col-2 d-flex flex-column">
                <label for="">Data Nascimento</label>
                <input type="date" name="data_nascimento"  value="{{ (isset($Colaborador))? $Colaborador->data_nascimento :'' }}">
            </div>
            <div class="col-3 d-flex flex-column" >
                <label for="">CPF</label>
                <input type="number" name="CPF" required id="">
            </div>
            <div class="col-3 d-flex flex-column">
                <label for="">Foto</label>
                <input type="file" name="foto">
            </div>
        </div>
        </section>
    <section>
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
    </section>
    @csrf
    <section>
        @include('endereco.form-endereco')
    </section>
    <section>
        @include('contato.form-contato')
    </section>
    <section>
        <x-select-localapoio/>
    </section>



    <input type="submit" value="Salvar" class="btn btn-primary">
</fieldset>
