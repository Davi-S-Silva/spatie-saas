@php
    use App\Models\Empresa;
@endphp

<div class="col-5">
    <label for="">Empresa</label>
    <select name="empresa_id" id="">
        <option value="">Selecione a Empresa</option>
        @foreach (Empresa::All() as $empresa)
            <option value="{{ $empresa->id }}">{{ $empresa->nome }}</option>
        @endforeach
    </select>
</div>
