@php
    use App\Models\Proprietario;
@endphp

<div class="" >
    {{-- @if (Proprietario::All()->count()!= 0) --}}
    <label for="">Selecione o Proprietário</label>
    <select name="proprietario" id="PropVeiculo" required class="row">
        <option value="">Selecione uma opção</option>
        @foreach(Proprietario::All() as $propietario)
            <option value="{{ $propietario->id }}">{{ $propietario->nome_razao_social }} </option>
        @endforeach
    </select>
    {{-- @endif --}}

</div>
