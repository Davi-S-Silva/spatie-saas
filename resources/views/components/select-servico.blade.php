@php
    use App\Models\Servico;
@endphp
<div class="d-flex flex-wrap justify-around align-items-center">
    <div class="col-5">
        <label for="" class="form-label">Serviço</label>
        <select name="Servico" id="" class="form-control">
            <option value="">Selecione o Servico</option>
            @foreach (Servico::all() as $servico)
            <option value="{{ $servico->id }}">{{ $servico->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-5">
        <label for="" class="form-label">Descrição</label>
        <textarea name="DescricaoServico" id="" cols="30" rows="3" class="form-control"></textarea>
    </div>
    <div  class="col-12 d-flex justify-around">
        <div class="col-4">
            <label for="" class="form-label">Tipo de Prazo</label>
            <select name="TipoPrazo" id="" class="form-control">
                <option value="">Selecione o Tipo de Prazo</option>
                <option value="Nao Aplicavel">Não Aplicavel</option>
                <option value="Dias">Dias</option>
                <option value="KM">KM</option>
            </select>
        </div>
        <div class="col-4">
            <label for="" class="form-label">Prazo</label>
            <input type="number" name="Prazo" id="" class="form-control ">
        </div>
        <div class="col-3">
            <label for="" class="form-label">Valor Serviço</label>
            <input type="text" name="Valor" id="" class="form-control">
        </div>
    </div>
</div>
