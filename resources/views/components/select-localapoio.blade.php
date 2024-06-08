@php
    use App\Models\Empresa;
@endphp

<div class="col-5">
    <label for="">Empresa e local de apoio</label>
    <select name="empresa_local_apoio_id" id="">
        <option value="">Selecione uma opção</option>
        @foreach (Empresa::All() as $empresa)
            {{-- <option value="{{ $empresa->id }}">{{ $empresa->nome }}</option> --}}
            @foreach ($empresa->localapoios as $local)
            <option value="{{ $local->id }}">{{ $empresa->nome_fantasia }} - {{ $local->name }}</option>
            @endforeach
        @endforeach
    </select>
</div>
