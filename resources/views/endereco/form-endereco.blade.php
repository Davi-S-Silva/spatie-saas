@php
    use App\Models\Municipio;
    use App\Models\Estado;
@endphp

{{-- <form action="" method="post"> --}}
<div class="col-12 border p-2">
    {{-- <legend>Endereço</legend> --}}
    <div>
        <label for="">Rua</label>
        <input type="text" class="form-control border-black rounded" name="rua" id=""
            value="{{ !empty($endereco) ? $endereco->endereco : '' }}">
    </div>
    <div>
        <label for="">Numero</label>
        <input type="number" class="form-control border-black rounded" name="numero" id=""
            value="{{ !empty($endereco) ? $endereco->numero : '' }}">
    </div>
    <div>
        <label for="">Bairro</label>
        <input type="text" class="form-control border-black rounded" name="bairro" id=""
            value="{{ !empty($endereco) ? $endereco->bairro : '' }}">
    </div>
    <div>
        <label for="">Cep</label>
        <input type="number" class="form-control border-black-black rounded" name="cep" id=""
            value="{{ !empty($endereco) ? $endereco->cep : '' }}">
    </div>
    <div>
        @php
            $cidade = (!empty($endereco))?$endereco->cidade_id:'';
        @endphp
        <label for="">Cidade</label>
        <x-select-cidade :cidades=$cidades :endereco=$cidade  :name=null :required=true/>
    </div>
    <div>
        <label for="" class="form-label">Estado</label>
        <select name="estado_id" id="" class="form-control border-black">
            <option value="" selected>Selecione Um Estado</option>
            @foreach (Estado::orderBy('nome', 'asc')->get() as $estado)
                @if ( !empty($endereco) && $estado->id==$endereco->estado_id)
                    <option value="{{ $estado->id }}" selected>{{ $estado->uf }}</option>
                @else
                    {{-- <option value="{{ $cidade->id }}">{{ $cidade->nome }} - {{ $cidade->estado->nome }}</option> --}}
                    <option value="{{ $estado->id }}">{{ $estado->uf }}</option>
                @endif
            @endforeach
        </select>
    </div>
</div>
{{-- </form> --}}
