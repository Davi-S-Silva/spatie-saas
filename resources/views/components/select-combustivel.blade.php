@php
    use App\Models\Combustivel;
@endphp
<label for="">Combustivel</label>
<select name="Combustivel" id="" required class="form-control">
    <option value="">Selecione o combustivel</option>
    @foreach (Combustivel::all() as $item)
        <option value="{{ $item->id }}">{{ $item->name }}</option>
    @endforeach
</select>
