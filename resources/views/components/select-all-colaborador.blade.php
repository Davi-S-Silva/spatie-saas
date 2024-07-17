@php
    use App\Models\Colaborador;
@endphp

<div class="col-5">
    <label for="">Colaborador</label>
    <select name="colaborador_id" id="" required>
        <option value="">Selecione a Colaborador</option>
        @foreach (Colaborador::All() as $colaborador)
            <option value="{{ $colaborador->id }}">{{ $colaborador->name }}</option>
        @endforeach
    </select>
</div>
