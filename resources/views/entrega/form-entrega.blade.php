<fieldset>
    <legend>
        <label for="">Dados da Entrega</label>
    </legend>
    <div class="col-4">
        <label for="">Motorista da Entrega</label>
        <x-select-colaborador :funcao=1 />
    </div>
    <div>
        <label for="">Caminhão</label>
        <x-select-veiculo />
    </div>

    <section class="d-flex align-items-start my-2">
        <div class="d-flex align-items-end flex-wrap append-colaborador-entrega  col-4">
            <div class="colaborador-entrega my-2 col-12" id="Clone_Append_Colaborador">
                <x-select-ajudante/>
            </div>
        </div>

        <div>
            <a href="#" class="link-add-colaborador-entrega btn btn-outline-primary mx-2"><i
                    class="fa-regular fa-plus"></i></a>
        </div>


    </section>
    {{-- <div>
        <input type="checkbox" name="SemAjudante" id="SemAjudante"><label for="SemAjudante">Sem Ajudante</label>
    </div> --}}
    @csrf
    <div>
        <input type="submit" value="Salvar" class="btn btn-primary">
    </div>
</fieldset>
