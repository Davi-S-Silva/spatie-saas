@php
    use App\Models\Especialidade;
@endphp

<div>
<select name="Especialidade" id="" class="form-control">
    <option value="">Selecione uma especialidade</option>
    @foreach (Especialidade::all() as $item)
        <option value="{{ $item->id }}">{{ $item->nome }}</option>
    @endforeach
</select>
</div>
