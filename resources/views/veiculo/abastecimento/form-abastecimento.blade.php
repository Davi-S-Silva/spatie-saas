<fieldset>
    <div>
        <label for="">Cupom</label>
        <input type="number" name="Cupom" id="" class="form-control">
    </div>
    <div>
        <label for="">KM</label>
        <input type="text" name="Km" id="" class="form-control">
    </div>
    <div>
        <label for="">Litros</label>
        <input type="text" name="Litro" id="" class="form-control">
    </div>
    <div>
        <label for="">Valor</label>
        <input type="text" name="Valor" id="" class="form-control">
    </div>
    <div>
        <x-select-combustivel/>
    </div>

    @hasanyrole('super-admin|admin|tenant-admin|tenant-admin-master')
        <x-select-colaborador :funcao=null/>
        <x-select-veiculo/>
    @endhasanyrole

    <div class="my-2">
        <label for="">Foto Cupom</label>
        <input type="file" name="FotoCupom" id="" class="form-control">
    </div>
    <div class="my-2">
        <label for="">Foto Hodometro / Velocimetro</label>
        <input type="file" name="FotoHodometro" id="" class="form-control">
    </div>
    <div class="my-2">
        <label for="">Foto Bomba de Abastecimento</label>
        <input type="file" name="FotoBomba" id="" class="form-control">
    </div>

   {{-- @if (Auth::user()->colaborador()->count() != 0 && Auth::user()->colaborador()->first()->veiculo()->count() == 0)
   <x-select-veiculo/>
   @endif --}}

    <div>
        @csrf
        <input type="submit" value="Salvar" class="btn btn-primary my-2">
    </div>
</fieldset>
