@php
    use App\Models\Colaborador;
@endphp
<section class="d-flex flex-column">
    <div class="d-flex justify-between px-2">
        <label for="">Ajudante</label>
        <a href="#" class="remove_select_colaborador">X</a>
    </div>
    <select name="ajudante[]" class="colaborador" id="">
        <option value="">Selecione o Colaborador</option>
        @foreach (Colaborador::where('funcao_id',2)->orwhere('funcao_id',3)->get() as $item)
        @if (isset($colaborador) && $colaborador==$item->id)
            <option value="{{ $item->id }}" selected>{{ $item->name }}</option>
        @else
            <option value="{{ $item->id }}">{{ $item->name }}</option>
        @endif
        @endforeach
    </select>
</section>
