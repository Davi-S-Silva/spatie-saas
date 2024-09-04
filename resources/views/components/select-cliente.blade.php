@php
    use App\Models\Filial;
@endphp
<div>
    <select name="origem" id="" {{ (isset($required))?$required:'' }} class="form-control border-black">
        <option value="">Selecione  origem</option>
        @foreach (Filial::orderBy('nome_fantasia','asc')->get() as $item)
            <option value="{{ $item->id }}">{{ $item->nome_fantasia }}</option>
        @endforeach
    </select>
</div>
