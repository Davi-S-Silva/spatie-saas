@php
    use App\Models\Municipio;
    use App\Models\Estado;
@endphp

{{-- <form action="" method="post"> --}}
    <div>
        <label for="">Rua</label>
        <input type="text" name="rua" id="" value="{{(!empty($endereco))?$endereco->endereco:''}}">
    </div>
    <div>
        <label for="">Numero</label>
        <input type="number" name="numero" id="" value="{{(!empty($endereco))?$endereco->numero:''}}">
    </div>
    <div>
        <label for="">Bairro</label>
        <input type="text" name="bairro" id="" value="{{(!empty($endereco))?$endereco->bairro:''}}">
    </div>
    <div>
        <label for="">Cep</label>
        <input type="number" name="cep" id="" value="{{(!empty($endereco))?$endereco->cep:''}}">
    </div>
    <div>
        <label for="">Cidade</label>
        select cidade
        <select name="cidade_id" id="">
            <option value="" selected>Selecione Uma Cidade</option>
            @foreach (Municipio::orderBy('nome','asc')->get() as $cidade)
                <option value="{{ $cidade->id }}">{{ $cidade->nome }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label for="">Estado</label>
        <select name="estado_id" id="">
            <option value="" selected>Selecione Um Estado</option>
            @foreach (Estado::orderBy('nome','asc')->get() as $estado)
                <option value="{{ $estado->id }}">{{ $estado->uf }}</option>
            @endforeach
        </select>
        select estado
    </div>
{{-- </form> --}}
