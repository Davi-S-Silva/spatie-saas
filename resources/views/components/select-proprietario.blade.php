@php
    use App\Models\Proprietario;
@endphp

<div class="col-5">
    <label for="">Selecione o Proprietário</label>
    <select name="proprietario_id" id="">
        <option value="">Selecione uma opção</option>
        @foreach(Proprietario::All() as $propietario)
            <option value="{{ $propietario->id }}">{{ $propietario->nome_razao_social }} </option>
        @endforeach
    </select>
</div>
