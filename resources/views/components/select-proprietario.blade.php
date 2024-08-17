@php
    use App\Models\Proprietario;
@endphp

<div class="col-sm-5 col-12" >
    {{-- @if (Proprietario::All()->count()!= 0) --}}
    <label for="" class="form-label">Selecione o Proprietário</label>
    <select name="proprietario" id="PropVeiculo" required class="form-control">
        <option value="">Selecione uma opção</option>
        @foreach(Proprietario::All() as $propietario)
            <option value="{{ $propietario->id }}">{{ $propietario->nome_razao_social }} </option>
        @endforeach
    </select>
    {{-- @endif --}}

</div>
