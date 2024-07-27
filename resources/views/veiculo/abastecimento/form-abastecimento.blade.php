@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<fieldset>
    <div>
        <label for="">Cupom</label>
        <input type="number" name="Cupom" id="" class="form-control" value="{{ old('Cupom') }}">
        @if ($errors->has('Cupom'))
        <div class="alert alert-danger">
            {{ $errors->first('Cupom') }}
        </div>
        @endif
    </div>
    <div>
        <label for="">KM</label>
        <input type="text" name="Km" id="" class="form-control" value="{{ old('Km') }}">
        @if ($errors->has('Km'))
        <div class="alert alert-danger">
            {{ $errors->first('Km') }}
        </div>
        @endif
    </div>
    <div>
        <label for="">Litros</label>
        <input type="text" name="Litro" id="" class="form-control" value="{{ old('Litro') }}">
        @if ($errors->has('Litro'))
        <div class="alert alert-danger">
            {{ $errors->first('Litro') }}
        </div>
        @endif
    </div>
    <div>
        <label for="">Valor</label>
        <input type="text" name="Valor" id="" class="form-control" value="{{ old('Valor') }}">
        @if ($errors->has('Valor'))
        <div class="alert alert-danger">
            {{ $errors->first('Valor') }}
        </div>
        @endif
    </div>
    <div>
        <x-select-fornecedor :fornecedores=$fornecedores/>
        @if ($errors->has('Fornecedor'))
        <div class="alert alert-danger">
            {{ $errors->first('Fornecedor') }}
        </div>
        @endif
    </div>
    <div>
        <x-select-combustivel/>
        @if ($errors->has('Combustivel'))
        <div class="alert alert-danger">
            {{ $errors->first('Combustivel') }}
        </div>
        @endif
    </div>

    @hasanyrole('super-admin|admin|tenant-admin|tenant-admin-master')
        <x-select-colaborador :funcao=null/>
        @if ($errors->has('colaborador'))
        <div class="alert alert-danger">
            {{ $errors->first('colaborador') }}
        </div>
        @endif
        <x-select-veiculo/>
        @if ($errors->has('veiculo'))
        <div class="alert alert-danger">
            {{ $errors->first('veiculo') }}
        </div>
        @endif
    @endhasanyrole

    <div class="my-3">
        <label for="">Foto Cupom</label>
        <input type="file" name="FotoCupom" id="" class="form-control">
        @if ($errors->has('FotoCupom'))
        <div class="alert alert-danger">
            {{ $errors->first('FotoCupom') }}
        </div>
        @endif
    </div>

    <div class="my-3">
        <label for="">Foto Bomba de Abastecimento</label>
        <input type="file" name="FotoBomba" id="" class="form-control">
        @if ($errors->has('FotoBomba'))
        <div class="alert alert-danger">
            {{ $errors->first('FotoBomba') }}
        </div>
        @endif
    </div>
    <div class="my-3">
        <label for="">Foto Hodometro / Velocimetro</label>
        <input type="file" name="FotoHodometro" id="" class="form-control">
        @if ($errors->has('FotoHodometro'))
        <div class="alert alert-danger">
            {{ $errors->first('FotoHodometro') }}
        </div>
        @endif
    </div>

   {{-- @if (Auth::user()->colaborador()->count() != 0 && Auth::user()->colaborador()->first()->veiculo()->count() == 0)
   <x-select-veiculo/>
   @endif --}}

    <div>
        @csrf
        <input type="submit" value="Salvar" class="btn btn-primary my-2">
    </div>
</fieldset>
