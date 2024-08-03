@php
    use App\Models\TipoVeiculo;
@endphp

<div>
    <label for="">Tipo Veiculo</label>
    <select name="TipoVeiculo" id="" required>
        <option value="">Selecione o tipo do veiculo</option>
        @foreach (TipoVeiculo::all() as $item)
            <option value="{{ $item->id }}">{{ $item->name }}</option>
        @endforeach
    </select>
</div>
