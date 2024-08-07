<div>
    <form action="" name="StopEntrega" class="form_toggle_entrega" method="post">
        <legend>Finalizar entrega <span></span></legend>
        {{-- <div class="col-12">
            <x-select-colaborador :funcao=1/>
        </div> --}}
        <div>
            <label for="">Km Final</label>
            <input type="text" required name="KmFinal">
        </div>
        <div>
            <label for="">Local de destino</label>
            <select name="LocalDestino" id="">
                <option value="">Selecione o local de destino do veiculo</option>
                @foreach ($localMovimentacao as $local)
                @if ($local->title != "Rota")
                    <option value="{{ $local->id }}">{{ $local->title }}</option>
                @endif
                @endforeach
            </select>
        </div>
        <input type="hidden" name="Entrega">
        @csrf
        <input type="submit" class="btn btn-primary" value="Salvar">
    </form>
</div>
