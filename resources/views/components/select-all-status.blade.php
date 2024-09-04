<div>
    <select name="status" id="" {{ (isset($required))?$required:'' }} class="form-control border-black">
        <option value="">Selecione  origem</option>
        @foreach ($statusAll as $item)
            <option value="{{ $item->id }}">{{ $item->descricao }}</option>
        @endforeach
    </select>
</div>
