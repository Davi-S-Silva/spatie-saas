@php
    use App\Models\Colaborador;
@endphp
<div>
    <select name="colaborador" id="" required>
        <option value="">Selecione o Colaborador</option>
        @foreach (Colaborador::where('funcao_id',$funcao)->get() as $item)
        @if (isset($colaborador) && $colaborador==$item->id)
            <option value="{{ $item->id }}" selected>{{ $item->name }}</option>
        @else
            <option value="{{ $item->id }}">{{ $item->name }}</option>
        @endif
        @endforeach
    </select>
</div>
