@php
    use App\Models\Empresa;
@endphp

{{-- @unlessrole ('super-admin') --}}
<div class="col-5">
    <label for="">Empresa e local de apoio</label>
    <select name="empresa_local_apoio_id" id="" required>
        <option value="">Selecione uma opção</option>
        @foreach (Empresa::All() as $empresa)
            {{-- <option value="{{ $empresa->id }}">{{ $empresa->nome }}</option> --}}
            @foreach ($empresa->localapoios as $local)
                @if (isset($carga) && $carga==$local->id)
                    <option value="{{ $local->id }}" selected>{{ $empresa->nome_fantasia }} - {{ $local->name }}</option>
                {{-- @elseif($colaborador) --}}
                @else
                    <option value="{{ $local->id }}">{{ $empresa->nome_fantasia }} - {{ $local->name }}</option>
                @endif
            @endforeach
        @endforeach
    </select>
</div>
{{-- @endunlessrole --}}
