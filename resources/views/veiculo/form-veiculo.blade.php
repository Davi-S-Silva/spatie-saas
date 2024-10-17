<fieldset {{ isset($disabled)?$disabled:'' }}>
    <div class="d-flex col-12 justify-between flex-wrap">
        <div class="form-group col-sm-1 col-12">
            <label for="" class="form-label">Placa</label>
            <input type="text" name="Placa" required class="form-control  rounded border-zinc-300" value="{{ isset($veiculo)?$veiculo->placa:'' }}"/>
        </div>
        <div class="form-group col-sm-4 col-12">
            <label for="" class="form-label">Renavam</label>
            <input type="text" name="Renavam" id="" required class="form-control  rounded border-zinc-300" value="{{ isset($veiculo)?$veiculo->renavam:'' }}">
        </div>
        <div class="form-group col-sm-4 col-12">
            <label for="" class="form-label">Chassi</label>
            <input type="text" name="Chassi" id="" required class="form-control  rounded border-zinc-300" value="{{ isset($veiculo)?$veiculo->chassi:'' }}">
        </div>
    </div>
    <div class="col-12 form-group d-flex justify-between flex-wrap">
        <div class="form-group  col-sm-2 col-12">
            <label for="" class="form-label">Ano Modelo</label>
            <select name="AnoModelo" id="" required class="form-control  rounded border-zinc-300">
                <option value="">Ano Modelo</option>
                @for ($i = 1950; $i <= date('Y'); $i++)
                    @if (isset($veiculo) && $i == $veiculo->ano_modelo)
                        <option value="{{ $i }}" selected>{{ $i }}</option>
                    @else
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endif
                @endfor
            </select>
        </div>
        <div class="form-group  col-sm-2 col-12">
            <label for="" class="form-label">Ano Fabricação</label>
            <select name="AnoFabricacao" id="" required class="form-control  rounded border-zinc-300">
                <option value="">Ano Fabricação</option>
                @for ($i = 1950; $i <= date('Y'); $i++)
                    @if (isset($veiculo) && $i == $veiculo->ano_fabricacao)
                        <option value="{{ $i }}" selected>{{ $i }}</option>
                    @else
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endif
                @endfor
            </select>
        </div>
        <div class="form-group  col-sm-2 col-12">
            <label for="" class="form-label">Ano Exercicio</label>
            <select name="AnoExercicio" id="" required class="form-control  rounded border-zinc-300">
                <option value="">Ano Exercicio</option>
                @for ($i = 1950; $i <= date('Y'); $i++)
                    @if (isset($veiculo) && $i == $veiculo->ano_exercicio)
                        <option value="{{ $i }}" selected>{{ $i }}</option>
                    @else
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endif
                @endfor
            </select>
        </div>
    </div>

    <div class="col-12 d-flex justify-between flex-wrap">
        <div class="form-group">
            <label for="" class="form-label">Potência</label>
            <input type="text" name="Potencia" id="" required class="form-control  rounded border-zinc-300" value="{{ isset($veiculo)?$veiculo->potencia:'' }}">
        </div>
        <div class="form-group">
            <label for="" class="form-label">Capacidade</label>
            <input type="text" name="Capacidade" id="" required
                class="form-control  rounded border-zinc-300" value="{{ isset($veiculo)?$veiculo->capacidade:'' }}">
        </div>
        <div class="form-group" class="form-group">
            <label for="" class="form-label">Peso Bruto</label>
            <input type="text" name="PesoBruto" id="" required
                class="form-control  rounded border-zinc-300 rounded border-zinc-300"
                value="{{ isset($veiculo)?$veiculo->peso_bruto:'' }}">
        </div>
        <div class="form-group">
            <label for="" class="form-label">Carroceria</label>
            <input type="text" name="Carroceria" id="" class="form-control  rounded border-zinc-300"
                required value="{{ isset($veiculo)?$veiculo->carroceria:'' }}">
        </div>

        <div class="form-group">
            <label for="" class="form-label">Cor</label>
            <input type="text" name="Cor" id="" class="form-control  rounded border-zinc-300" required
            value="{{ isset($veiculo)?$veiculo->cor:'' }}">
        </div>
    </div>

    <div class="d-flex col-12 justify-between flex-wrap">
        <div class="form-group col-sm-3 col-12">
            @if (isset($veiculo))
                <x-select-tipo-veiculo :veiculo=$veiculo/>
            @else
                <x-select-tipo-veiculo/>
            @endif
        </div>
        <div class="form-group col-sm-3 col-12">
            <label for="" class="form-label">Lotação</label>
            <select name="Lotacao" id="" required class="form-control  rounded border-zinc-300">
                <option value="">Selecione a lotação</option>
                @for ($i = 0; $i <= 8; $i++)
                    @if (isset($veiculo) && $i == $veiculo->lotacao)
                        <option value="{{ $i }}" selected>{{ $i }}</option>
                    @else
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endif
                @endfor
            </select>
        </div>
        <div class="form-group col-sm-3 col-12">
            <label for="" class="form-label">Eixo</label>
            <select name="Eixo" id="" required class="form-control  rounded border-zinc-300">
                <option value="">Selecione os Eixos</option>
                @for ($i = 0; $i <= 4; $i++)
                    @if (isset($veiculo) && $i == $veiculo->eixo)
                        <option value="{{ $i }}" selected>{{ $i }}</option>
                    @else
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endif
                @endfor
            </select>
        </div>
    </div>
    <div class="form-group d-flex col-12 justify-between flex-wrap">
        <div class="form-group col-sm-2 col-12">
            <label for="" class="form-label">Data Aquisição</label>
            <input type="date" name="DataAquisicao" class="form-control  rounded border-zinc-300" id=""
                required value="{{ isset($veiculo)?$veiculo->data_aquisicao:'' }}">
        </div>
        <div class="form-group col-sm-3 col-12">
            @if (isset($veiculo))
                <x-select-combustivel :veiculo=$veiculo/>
            @else
                <x-select-combustivel/>
            @endif
        </div>
        <div class="form-group col-sm-3 col-12">
            <label for="" class="form-label">Categoria</label>
            @php
                $categoria = '';
                if(isset($veiculo)){
                    $categoria = $veiculo->categoria_veiculo_id;
                }
            @endphp
            <select name="Categoria" id="" required class="form-control  rounded border-zinc-300">
                <option value="">Selecione a categoria</option>
                <option value="1" {{ ($categoria==1)?'selected':'' }}>Aluguel</option>
                <option value="2" {{ ($categoria==2)?'selected':'' }}>Particular</option>
            </select>
        </div>
        <div class="form-group col-sm-3 col-12">
            <label for="" class="form-label">Marca/Modelo/Versão</label>
            <input type="text" name="MarcaModelo" id="" class="form-control  rounded border-zinc-300"
                required value="{{ isset($veiculo)?$veiculo->marca_modelo:'' }}">
        </div>
    </div>
    <div class="form-group col-12 d-flex flex-wrap">
        <div class="d-flex justify-start col-sm-9 col-12 align-items-end flex-wrap">
            @if (isset($veiculo))
                <x-select-proprietario :veiculo=$veiculo/>
            @else
                <x-select-proprietario/>
            @endif

            <a href="" id="LinkNovoProp" class="btn btn-outline-secondary col-sm-2 col-12">Outro Proprietário</a>
        </div>
        <div class="form-group col-12" id="NovoProp">
            {{-- <legend>Novo Proprietário</legend> --}}
            {{-- <form action="" method="post"> --}}
            {{-- <fieldset> --}}
            <div class="form-group col-sm-4 col-12">
                <label for="" class="form-label">Nome proprietário</label>
                <input type="text" name="NameProp" class="form-control  rounded border-zinc-300">
            </div>
            <div class="form-group col-sm-4 col-12">
                <label for="" class="form-label">Documento Proprientário</label>
                <input type="text" class="form-control rounded border-zinc-300" name="DocProp" id="">
            </div>
            {{-- </fieldset> --}}
            {{-- </form> --}}
        </div>
        <div class="form-group col-sm-2 col-12">
            <label for="" class="form-label">Km Atual</label>
            <input type="text" name="Km" class="form-control col-12 col-sm-2 rounded border-zinc-300" id=""
                required value="{{ isset($veiculo)?$veiculo->kms->last()->km:'' }}">
        </div>
    </div>
    @csrf
    @if (isset($veiculo))
        <x-select-localapoio :veiculo=$veiculo/>
    @else
        <x-select-localapoio/>
    @endif
    @if (!isset($disabled))
        <input type="submit" value="Salvar" class="btn btn-primary my-2">

    @endif
</fieldset>
@if (isset($disabled))
<a href="{{ route('veiculo.edit',['veiculo'=>$veiculo->id]) }}" class="btn btn-primary mt-2 col-1">Editar</a>
@endif
