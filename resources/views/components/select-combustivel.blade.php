@php
    use App\Models\Combustivel;
@endphp
<label for="">Combustivel</label>
<select name="Combustivel" id="" class="form-control">
    <option value="">Selecione o combustivel</option>
    @foreach (Combustivel::all() as $item)
    @if (!is_null(old('Combustivel')) && old('Combustivel')==$item->id)
        <option value="{{ $item->id }}" selected>{{ $item->name }}</option>
    @else
        <option value="{{ $item->id }}">{{ $item->name }}</option>
    @endif
    @endforeach
</select>
