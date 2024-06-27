@php
    use App\Models\Colaborador;
@endphp
<section class="d-flex flex-column">
    <div class="d-flex justify-between px-2">
        @if ($funcao==2)
        <label for="">Ajudante</label>
        @else
        <label for="">Motorista</label>
        @endif
        {{-- <a href="#" class="remove_select_colaborador">X</a> --}}
    </div>
    <select name="colaborador" class="colaborador" id="" required>
        <option value="">Selecione o Colaborador</option>
        @foreach (Colaborador::where('funcao_id',$funcao)->get() as $item)
        @if (isset($colaborador) && $colaborador==$item->id)
            <option value="{{ $item->id }}" selected>{{ $item->name }}</option>
        @else
            <option value="{{ $item->id }}">{{ $item->name }}</option>
        @endif
        @endforeach
    </select>
</section>
