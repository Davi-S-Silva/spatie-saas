<fieldset>
    <div class="d-flex col-12 justify-between flex-wrap">
        <div class="form-group col-sm-1 col-12">
            <label for="" class="form-label">Placa</label>
            <input type="text" name="Placa" required class="form-control  rounded border-zinc-300" />
        </div>
        <div class="form-group col-sm-4 col-12">
            <label for="" class="form-label">Renavam</label>
            <input type="text" name="Renavam" id="" required class="form-control  rounded border-zinc-300">
        </div>
        <div class="form-group col-sm-4 col-12">
            <label for="" class="form-label">Chassi</label>
            <input type="text" name="Chassi" id="" required class="form-control  rounded border-zinc-300">
        </div>
    </div>
    <div class="col-12 form-group d-flex justify-between flex-wrap">
        <div class="form-group  col-sm-2 col-12">
            <label for="" class="form-label">Ano Modelo</label>
            <select name="AnoModelo" id="" required class="form-control  rounded border-zinc-300">
                <option value="">Ano Modelo</option>
                @for ($i = 1950; $i <= date('Y'); $i++)
                    <option value="{{ $i }}">{{ $i }}</option>
                @endfor
            </select>
        </div>
        <div class="form-group  col-sm-2 col-12">
            <label for="" class="form-label">Ano Fabricação</label>
            <select name="AnoFabricacao" id="" required class="form-control  rounded border-zinc-300">
                <option value="">Ano Fabricação</option>
                @for ($i = 1950; $i <= date('Y'); $i++)
                    <option value="{{ $i }}">{{ $i }}</option>
                @endfor
            </select>
        </div>
        <div class="form-group  col-sm-2 col-12">
            <label for="" class="form-label">Ano Exercicio</label>
            <select name="AnoExercicio" id="" required class="form-control  rounded border-zinc-300">
                <option value="">Ano Exercicio</option>
                @for ($i = 1950; $i <= date('Y'); $i++)
                    <option value="{{ $i }}">{{ $i }}</option>
                @endfor
            </select>
        </div>
    </div>

    <div class="col-12 d-flex justify-between flex-wrap">
        <div class="form-group">
            <label for="" class="form-label">Potência</label>
            <input type="text" name="Potencia" id="" required class="form-control  rounded border-zinc-300">
        </div>
        <div class="form-group">
            <label for="" class="form-label">Capacidade</label>
            <input type="text" name="Capacidade" id="" required
                class="form-control  rounded border-zinc-300">
        </div>
        <div class="form-group" class="form-group">
            <label for="" class="form-label">Peso Bruto</label>
            <input type="text" name="PesoBruto" id="" required
                class="form-control  rounded border-zinc-300 rounded border-zinc-300">
        </div>
        <div class="form-group">
            <label for="" class="form-label">Carroceria</label>
            <input type="text" name="Carroceria" id="" class="form-control  rounded border-zinc-300"
                required>
        </div>

        <div class="form-group">
            <label for="" class="form-label">Cor</label>
            <input type="text" name="Cor" id="" class="form-control  rounded border-zinc-300" required>
        </div>
    </div>

    <div class="d-flex col-12 justify-between flex-wrap">
        <div class="form-group col-sm-3 col-12">
            <x-select-tipo-veiculo />
        </div>
        <div class="form-group col-sm-3 col-12">
            <label for="" class="form-label">Lotação</label>
            <select name="Lotacao" id="" required class="form-control  rounded border-zinc-300">
                <option value="">Selecione a lotação</option>
                @for ($i = 0; $i <= 8; $i++)
                    <option value="{{ $i }}">0{{ $i }}P</option>
                @endfor
            </select>
        </div>
        <div class="form-group col-sm-3 col-12">
            <label for="" class="form-label">Eixo</label>
            <select name="Eixo" id="" required class="form-control  rounded border-zinc-300">
                <option value="">Selecione os Eixos</option>
                @for ($i = 0; $i <= 4; $i++)
                    <option value="{{ $i }}">0{{ $i }}</option>
                @endfor
            </select>
        </div>
    </div>
    <div class="form-group d-flex col-12 justify-between flex-wrap">
        <div class="form-group col-sm-2 col-12">
            <label for="" class="form-label">Data Aquisição</label>
            <input type="date" name="DataAquisicao" class="form-control  rounded border-zinc-300" id=""
                required>
        </div>
        <div class="form-group col-sm-3 col-12">
            <x-select-combustivel />
        </div>
        <div class="form-group col-sm-3 col-12">
            <label for="" class="form-label">Categoria</label>
            <select name="Categoria" id="" required class="form-control  rounded border-zinc-300">
                <option value="">Selecione a categoria</option>
                <option value="1">Aluguel</option>
                <option value="2">Particular</option>
            </select>
        </div>
        <div class="form-group col-sm-3 col-12">
            <label for="" class="form-label">Marca/Modelo/Versão</label>
            <input type="text" name="MarcaModelo" id="" class="form-control  rounded border-zinc-300"
                required>
        </div>
    </div>
    <div class="form-group col-12 d-flex flex-wrap">
        <div class="d-flex justify-start col-sm-9 col-12 align-items-end flex-wrap">
            <x-select-proprietario />
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
                required>
        </div>
    </div>
    @csrf
    <x-select-localapoio />
    <input type="submit" value="Salvar" class="btn btn-primary my-2">
</fieldset>
