<fieldset>
    <div>
        <label for="">Placa</label>
        <input type="text" name="Placa" required/>
    </div>
    <div>
        <x-select-localapoio/>
        <x-select-proprietario/>
    </div>
    @csrf
    <input type="submit" value="Salvar" class="btn btn-primary">
</fieldset>
