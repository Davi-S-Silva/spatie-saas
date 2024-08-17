<fieldset>
    <section class="d-flex col-12 justify-around flex-wrap">
        <div class="col-sm-4 col-12 mx-1">
            <div class="col-12">
                <label for="" class="form-label">Nome/Razão Social</label>
                <input type="text" name="Name" class="form-control rounded border" id="">
            </div>
            <div class="col-12">
                <label for="" class="form-label">CPF/CNPJ</label>
                <input type="number" name="Doc" class="form-control rounded border" id="">
            </div>
        </div>
        <div class=" col-sm-4 col-12">
            <div class="col-12">
                <label for="" class="form-label">Especialidade</label>
                <x-select-especialidade />
            </div>
            <div class="col-12">
                <label for="" class="form-label">Descrição</label>
                <input type="text" name="DescricaoFornecedor" class="form-control rounded border" id="">
            </div>
        </div>
    </section>
    @csrf
    <div class="form-group d-flex col-12 justify-around flex-wrap my-3">
    <section  class="form-group col-sm-4 col-12">
        @include('endereco.form-endereco')
    </section>
    <section class="form-group col-sm-4 col-12">
        @include('contato.form-contato')
    </section>
</div>
    <input type="submit" value="Salvar" class="btn btn-primary">
</fieldset>
