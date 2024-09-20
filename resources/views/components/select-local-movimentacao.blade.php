<div>
    <label for="" class="form-label">Local de {{ $name }}</label>
    <select name="{{ $name }}" id="LocalPartida" class="form-control border-black">
        <option value="">Selecione o local de {{ $name }} do veiculo</option>
        @foreach ($localMovimentacao as $local)
        <option value="{{ $local->id }}">{{ $local->title }}</option>
        @endforeach
    </select>
</div>
