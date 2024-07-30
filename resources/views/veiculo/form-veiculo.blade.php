<fieldset>
    <div>
        <label for="">Placa</label>
        <input type="text" name="Placa" required/>
    </div>
    <div>
        <label for="">Ano Modelo</label>
        <select name="AnoModelo" id="">
            <option value="">Selecione o ano do modelo</option>
            @for ($i =1950 ; $i <=date('Y') ; $i++)
                <option value="{{ $i }}">{{ $i }}</option>
            @endfor
        </select>
    </div>
    <div>
        <label for="">Ano Fabricação</label>
        <select name="AnoFabricacao" id="">
            <option value="">Selecione o ano de fabricação</option>
            @for ($i =1950 ; $i <=date('Y') ; $i++)
                <option value="{{ $i }}">{{ $i }}</option>
            @endfor
        </select>
    </div>
    <div>
        <label for="">Ano Exercicio</label>
        <select name="AnoExercicio" id="">
            <option value="">Selecione o ano em Exercicio do crlv</option>
            @for ($i =1950 ; $i <=date('Y') ; $i++)
                <option value="{{ $i }}">{{ $i }}</option>
            @endfor
        </select>
    </div>
    <div>
        <label for="">Renavam</label>
        <input type="text" name="Renavam" id="">
    </div>
    <div>
        <label for="">Chassi</label>
        <input type="text" name="Chassi" id="">
    </div>
    <div>
        <label for="">Potência</label>
        <input type="text" name="Potencia" id="">
    </div>
    <div>
        <label for="">Capacidade</label>
        <input type="text" name="Capacidade" id="">
    </div>
    <div>
        <label for="">Peso Bruto</label>
        <input type="text" name="PesoBruto" id="">
    </div>
    <div>
        <label for="">Lotação</label>
        <select name="Lotacao" id="">
            <option value="">Selecione a lotação</option>
            @for ($i = 0; $i <=8 ; $i++)
            <option value="{{ $i }}">0{{ $i }}P</option>
            @endfor
        </select>
    </div>
    <div>
        <label for="">Eixo</label>
        <select name="Eixo" id="">
            <option value="">Selecione os Eixos</option>
            @for ($i = 0; $i <=4 ; $i++)
            <option value="{{ $i }}">0{{ $i }}</option>
            @endfor
        </select>
    </div>
    <div>
        <label for="">Carroceria</label>
        <input type="text" name="Carroceria" id="">
    </div>

    <div>
        <label for="">Cor</label>
        <input type="text" name="Cor" id="">
    </div>
    <div>
        <label for="">Data Aquisição</label>
        <input type="date" name="DataAquisicao" id="">
    </div>
    <div>
        <x-select-combustivel/>
    </div>
    <div>
        <label for="">Categoria</label>
        <select name="Categoria" id="">
            <option value="">Selecione a categoria</option>
            <option value="1">Aluguel</option>
            <option value="2">Particular</option>
        </select>
    </div>
    <div>
        <x-select-marca-modelo-veiculo />
    </div>
    <div>
        <x-select-localapoio/>
        <div class="d-flex justify-start align-items-end">
            <x-select-proprietario/>
            <a href="" id="LinkNovoProp" class="btn btn-info mx-5">Outro Proprietário</a>
        </div>
        <div class="row" id="NovoProp">
            <legend>Novo Proprietário</legend>
            {{-- <form action="" method="post"> --}}
                {{-- <fieldset> --}}
                    <div>
                        <label for="">Nome proprietário</label>
                        <input type="text" name="NameProp" id="">
                    </div>
                    <div>
                        <label for="">Documento Proprientário</label>
                        <input type="text" name="DocProp" id="">
                    </div>
                {{-- </fieldset> --}}
            {{-- </form> --}}
        </div>
        <div>
            <label for="">Km Atual</label>
            <input type="number" name="Km" id="" required>
        </div>
    </div>
    @csrf
    <input type="submit" value="Salvar" class="btn btn-primary">
</fieldset>
