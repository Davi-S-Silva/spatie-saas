
<select name="{{ (isset($name)?$name:'cidade_id') }}" id="" class="form-control border-black" {{ (isset($required))?'required':'' }}>
    <option value="" selected>Selecione Uma Cidade</option>
    @foreach ($cidades as $cidade)
        @if (!empty($endereco) && $cidade->id == $endereco)
            <option value="{{ $cidade->id }}" selected>{{ $cidade->nome }} - {{ $cidade->estado->nome }}</option>
        @else
            <option value="{{ $cidade->id }}">{{ $cidade->nome }} - {{ $cidade->estado->nome }}</option>
        @endif
    @endforeach
</select>
