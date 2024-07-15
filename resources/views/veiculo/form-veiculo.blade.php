<fieldset>
    <div>
        <label for="">Placa</label>
        <input type="text" name="Placa" required/>
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
    </div>
    @csrf
    <input type="submit" value="Salvar" class="btn btn-primary">
</fieldset>
