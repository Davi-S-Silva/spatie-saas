<fieldset>
    <div>
        <label for="">Local de partida</label>
        <select name="LocalPartida" id="LocalPartida">
            <option value="">Selecione o local de partida do veiculo</option>
            @foreach ($localMovimentacao as $local)
            <option value="{{ $local->id }}">{{ $local->title }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label for="">Local de destindo</label>
        <select name="LocalDestino" id="">
            <option value="">Selecione o local de destino do veiculo</option>
            @foreach ($localMovimentacao as $local)
            <option value="{{ $local->id }}">{{ $local->title }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-6">
        <label for="">Selecione o motorista</label>
        <x-select-colaborador :funcao=1/>
    </div>
    <div>
        <label for="">Selecione o veiculo</label>
        <x-select-veiculo/>
    </div>
    <div class="d-flex flex-column">
        <label for="">Digite uma descricao ou o motivo da movimentacao atual</label>
        <textarea name="DescricaoMov" id="" cols="30" rows="10"></textarea>
    </div>
    @csrf
    <div>
        <input type="submit" value="Salvar" class="btn btn-primary my-2">
    </div>
</fieldset>
