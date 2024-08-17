@php
    use App\Models\TipoVeiculo;
@endphp

<div class="col-12">
    <label for="" class="form-label">Tipo Veiculo</label>
    <select name="TipoVeiculo" id="" class="form-control" required>
        <option value="">Selecione o tipo do veiculo</option>
        @foreach (TipoVeiculo::all() as $item)
            <option value="{{ $item->id }}">{{ $item->name }}</option>
        @endforeach
    </select>
</div>
