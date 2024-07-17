@php
    use App\Models\Veiculo;
@endphp
<div>
    <label for="">Veiculo</label>
    <select name="veiculo" id="" required>
        <option value="">Selecione o veiculo</option>
        @foreach (Veiculo::All() as $item)
            @if (isset($veiculo) && $veiculo ==$item->id)
            <option value="{{ $item->id }}" selected>{{ $item->placa }}</option>
            @else
                <option value="{{ $item->id }}">{{ $item->placa }}</option>
            @endif
        @endforeach
    </select>
</div>
