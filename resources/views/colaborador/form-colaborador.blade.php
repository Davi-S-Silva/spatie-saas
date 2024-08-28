@php
    use App\Models\TipoColaborador;
    use App\Models\FuncaoColaborador;
@endphp
<fieldset>
    <section class="col-12">
        <div class="d-flex col-12 justify-around flex-wrap">
            <div class="col-sm-5 col-12 d-flex flex-column">
                <label for="" class="form-label" class="form-label">Nome</label>
                <input type="text" class="form-control border-black rounded" name="name" value="{{ (isset($Colaborador))? $Colaborador->name :'' }}">
            </div>
            <div class="col-sm-5 col-12 d-flex flex-column">
                <label for="" class="form-label">Apelido</label>
                <input type="text" class="form-control border-black rounded" name="apelido" value="{{ (isset($Colaborador))? $Colaborador->apelido :'' }}">
            </div>
        </div>
        <div class="d-flex col-12 justify-around my-3 flex-wrap">
            <div class="col-sm-2 col-12 d-flex flex-column">
                <label for="" class="form-label">Data Nascimento</label>
                <input type="date" class="form-control border-black rounded" name="data_nascimento"  value="{{ (isset($Colaborador))? $Colaborador->data_nascimento :'' }}">
            </div>
            <div class="col-sm-3 col-12 d-flex flex-column" >
                <label for="" class="form-label">CPF</label>
                <input type="number" class="form-control border-black rounded" name="CPF" required id="" value="{{ (isset($Colaborador))?$Colaborador->cpf():'' }}">
            </div>
            {{-- <div class="col-3 d-flex flex-column">
                <label for="" class="form-label">Foto</label>
                <input type="file" name="foto">
            </div> --}}
        </div>
        </section>
    <section class="d-flex flex-wrap justify-around">
        <div class=" col-sm-4 col-12">
            <label for="" class="form-label">Tipo Colaborador</label>
            <select name="tipo_id" id="" class="form-control border-black">
                <option value="">Selecione uma opção</option>
                @foreach (TipoColaborador::all() as $item)
                    <option value="{{ $item->id }}" {{ (isset($Colaborador) && $Colaborador->tipo_id == $item->id)? 'selected' :'' }}>{{ $item->tipo }}</option>
                @endforeach
            </select>
        </div>
        <div class=" col-sm-4 col-12">
            <label for="" class="form-label">Função Colaborador</label>
            <select name="funcao_id" id="" class="form-control border-black">
                <option value="">Selecione uma opção</option>
                @foreach (FuncaoColaborador::all() as $item)
                    <option value="{{ $item->id }}" {{ (isset($Colaborador) && $Colaborador->funcao_id == $item->id)? 'selected' :'' }}>{{ $item->funcao }}</option>
                @endforeach
            </select>
        </div>
    </section>
    <div class="form-group d-flex col-12 justify-around flex-wrap my-3">
        <section class="form-group col-sm-4 col-12 p-2">
            @if (isset($Colaborador))
            @include('endereco.form-endereco',['endereco'=>$Colaborador->enderecos()->first()])
            @else
            @include('endereco.form-endereco')
            @endif
        </section>
        <section class="form-group col-sm-4 col-12 p-2">
            @if (isset($Colaborador))
                @include('contato.form-contato',['contato'=>$Colaborador->contatos()->first()])
            @else
                @include('contato.form-contato')
            @endif
        </section>
    </div>
    <section>
        @if (isset($Colaborador))
                <x-select-localapoio :colaborador=$Colaborador/>
            @else
                <x-select-localapoio/>
            @endif
    </section>



    @csrf
    <input type="submit" value="Salvar" class="btn btn-primary">
</fieldset>
