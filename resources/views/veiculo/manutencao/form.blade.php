<fieldset>
    <div class="col-12 d-flex flex-wrap justify-around">
        <x-select-colaborador :funcao=null :required=false/>
        <x-select-veiculo />
        <x-select-fornecedor :fornecedores=$fornecedores/>
    </div>
    <div class="my-5">
        <div class="d-flex justify-center align-items-end">
            <div id="BaseServicoManutencao">
                <x-select-servico />
            </div>
            {{-- <a href="" class="btn btn-primary add_servico_manutencao"><i class="fa-regular fa-square-plus"></i></a> --}}
        </div>

    </div>
    @csrf
    <div class="col-4">
        <label for="" class="form-label">Agendamento</label>
        <input type="datetime-local" name="Agendamento" id="" class="form-control">
    </div>
    {{-- <div>
        <label for="">Data Inicio</label>
        <input type="datetime-local" name="DataInicio" id="">
    </div>
    <div>
        <label for="">Data Conclusao</label>
        <input type="datetime-local" name="DataFim" id="">
    </div> --}}

    <div>
        <label for="" class="form-label">Observação</label>
        <textarea name="Observacao" id="" cols="30" rows="10" class="form-control"></textarea>
        {{-- <a href="{{ route('servico-manutencao.create') }}"></a> --}}
    </div>
    <div id="AcoesFomrManutencao">
        <input type="submit" value="Salvar" name="SalvarNovaManutencao" class="btn btn-primary my-2">

    </div>
</fieldset>
