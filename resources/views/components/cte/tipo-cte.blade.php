<label for="" class="form-label">Tipo de CTe</label>
<select name="TipoCte" id="" {{ (isset($required))?'required':'' }} class="form-control border-black">
    <option value="">Selecione o tipo de CTe</option>
    @foreach ($tiposCte as $tipo)
        @if ($tipo->codigo==0)
            <option value="{{ $tipo->id }}" selected>{{ $tipo->codigo }} - {{ $tipo->descricao }}</option>
        @else
            <option value="{{ $tipo->id }}">{{ $tipo->codigo }} - {{ $tipo->descricao }}</option>
        @endif
    @endforeach
</select>
