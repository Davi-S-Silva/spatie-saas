@php
    use App\Models\Fornecedor;
@endphp
<label for="">Fornecedor</label>
<select name="Fornecedor" id="" class="form-control" required>
    <option value="">Selecione o Fornecedor</option>
    @foreach ($fornecedores as $item)
    @if (!is_null(old('Fornecedor')) && old('Fornecedor')==$item->id)
        <option value="{{ $item->id }}" selected>{{ $item->name }} - {{ $item->descricao }}</option>
    @else
        <option value="{{ $item->id }}">{{ $item->name }} - {{ $item->descricao }}</option>
    @endif
    @endforeach
</select>
