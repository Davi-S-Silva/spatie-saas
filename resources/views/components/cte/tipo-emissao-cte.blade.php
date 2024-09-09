<label for="" class="form-label">Tipo de Emissão</label>
<select name="TipoEmissaoCte" id="" {{ isset($required) ? 'required' : '' }}
    class="form-control border border-black">
    <option value="">Selecione o tipo de Serviço</option>
    @foreach ($tipoEmissaoCte as $tipo)
        @if ($tipo->codigo == 0)
            <option value="{{ $tipo->id }}" selected>{{ $tipo->codigo }} - {{ $tipo->descricao }}</option>
        @else
            <option value="{{ $tipo->id }}">{{ $tipo->codigo }} - {{ $tipo->descricao }}</option>
        @endif
    @endforeach
</select>
