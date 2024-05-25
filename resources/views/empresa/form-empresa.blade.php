<form action="{{ route('empresa.store') }}" method="post">
    <fieldset {{ ($disabled)?'disabled':'' }}>
        <section>
            <h1 class="font-bold" for="">Identificação</h1>
            <div class="d-flex justify-between flex-wrap">
                <div class="col-6">
                    <label  class="block text-gray-700 text-sm font-bold pt-2 mb-2" for="">Razão Social</label>
                    <input type="text" name="RazaoSocial" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="col-5">
                    <label class="block text-gray-700 text-sm font-bold pt-2 mb-2" for="">Nome Fantasia</label>
                    <input type="text" name="NomeFantasia" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="col-3">
                    <label class="block text-gray-700 text-sm font-bold pt-2 mb-2" for="">Telefone</label>
                    <input type="text" name="Telefone" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="col-4">
                    <label class="block text-gray-700 text-sm font-bold pt-2 mb-2" for="">Pessoa Física/Jurídica</label>
                    {{-- <input type="text" name="PessoaFisicaJuridica" class="form-control"> --}}
                    <select name="PessoaFisicaJuridica" id="" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        <option value="1">Pessoa Física</option>
                        <option value="2">Pessoa Jurídica</option>
                    </select>
                </div>
                <div class="col-4">
                    <label class="block text-gray-700 text-sm font-bold pt-2 mb-2" for="">CPF/CNPJ</label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="CpfCnpj" id="CpfCnpj" type="text" placeholder="Digite o Cpf ou Cnpj">
            </div>
        </section>
        <section class="mt-4">
            <h1 class="font-bold">Endereco</h1>

            @include('endereco.form-endereco')
        </section>

        @csrf

        @if (!$disabled)
        <input type="submit" value="Salvar" class="btn btn-primary mt-2">
        @endif
    </fieldset>
</form>
