<div>
    <select name="status" id="" {{ (isset($required))?$required:'' }} class="form-control border-black">
        <option value="">Selecione o status</option>
        @foreach ($statusAll as $item)
        {{-- @if (isset($status) && !empty($status) && $status==$item->id)
            <option value="{{ $item->id }}" selected>{{ $item->descricao }}</option>
        @else --}}
            <option value="{{ $item->id }}">{{ $item->descricao }}</option>
        {{-- @endif --}}
        @endforeach
    </select>
</div>
