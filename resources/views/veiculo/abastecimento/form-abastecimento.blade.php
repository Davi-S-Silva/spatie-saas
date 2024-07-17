<fieldset>
    <div>
        <label for="">Cupom</label>
        <input type="number" name="Cupom" id="">
    </div>
    <div>
        <label for="">KM</label>
        <input type="number" name="Km" id="">
    </div>
    <div>
        <label for="">Litros</label>
        <input type="text" name="Litro" id="">
    </div>
    <div>
        <label for="">Valor</label>
        <input type="text" name="Valor" id="">
    </div>
    <div>
        <x-select-combustivel/>
    </div>

    @hasanyrole('super-admin|admin|tenant-admin|tenant-admin-master')
        <x-select-colaborador :funcao=null/>
        <x-select-veiculo/>
    @endhasanyrole


   @if (Auth::user()->colaborador()->count() != 0 && Auth::user()->colaborador()->first()->veiculo()->count() == 0)
   <x-select-veiculo/>
   @endif

    <div>
        @csrf
        <input type="submit" value="Salvar" class="btn btn-primary my-2">
    </div>
</fieldset>
