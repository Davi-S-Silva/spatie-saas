@php
    $TipoDocumentacao = [
        ['id'=>1,'name'=>'CPF'],
        ['id'=>2,'name'=>'CNPJ'],
    ]
@endphp

<div>
    <select name="TipoDoc" id="">
        <option value="">Selecione o Tipo de Documento</option>
        @foreach ($TipoDocumentacao as $item)
            @if ($item['id'] == $tipodocempresa)
                <option value="{{ $item['id'] }}" selected>{{ $item['name'] }}</option>
            @else
                <option value=""{{ $item['id'] }}>{{ $item['name'] }}</option>
            @endif
        @endforeach
    </select>
</div>
