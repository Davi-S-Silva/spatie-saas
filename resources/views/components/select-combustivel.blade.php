@php
    use App\Models\Combustivel;
@endphp
<label for="" class="form-label">Combustivel</label>
<select name="Combustivel" id="" class="form-control border-black" {{ (isset($required))?'required':'' }}>
    <option value="">Selecione o combustivel</option>
    @foreach (Combustivel::all() as $item)
    @if ((!is_null(old('Combustivel')) && old('Combustivel')==$item->id) || (isset($veiculo->combustivel_id) && $veiculo->combustivel_id==$item->id))
        <option value="{{ $item->id }}" selected>{{ $item->name }}</option>
    @else
        <option value="{{ $item->id }}">{{ $item->name }}</option>
    @endif
    @endforeach
</select>
