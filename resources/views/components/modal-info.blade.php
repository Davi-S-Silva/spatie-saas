<div class="area-modal-info">
    <ul class="nav nav-tabs  bg-white" id="myTab_" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="geral-tab" data-bs-toggle="tab" data-bs-target="#geral" type="button"
                role="tab" aria-controls="geral" aria-selected="true">Geral</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="colaborador-tab" data-bs-toggle="tab" data-bs-target="#colaborador"
                type="button" role="tab" aria-controls="colaborador" aria-selected="true">Colaborador</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="veiculo-tab" data-bs-toggle="tab" data-bs-target="#veiculo" type="button"
                role="tab" aria-controls="veiculo" aria-selected="true">veiculo</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="cliente-tab_" data-bs-toggle="tab" data-bs-target="#cliente" type="button"
                role="tab" aria-controls="cliente" aria-selected="false">Cliente</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="fornecedor-tab_" data-bs-toggle="tab" data-bs-target="#fornecedor"
                type="button" role="tab" aria-controls="fornecedor" aria-selected="false">Fornecedor</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="fiscal-tab_" data-bs-toggle="tab" data-bs-target="#fiscal" type="button"
                role="tab" aria-controls="fiscal" aria-selected="false">Fiscal</button>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="geral" role="tabpanel" aria-labelledby="geral-tab">
            {{-- {{ $carga->countNotasPendentes() }} --}}
            Dados Gerais de cadastros iniciais
        </div>
        <div class="tab-pane fade" id="colaborador" role="tabpanel" aria-labelledby="colaborador-tab">
            <div id="PrimeiroColaborador">
                <header class="h1">Cadastre o primeiro colaborador</header>
                <form action="{{ route('colaboradores.store') }}" name="FormColaborador" method="post"
                    enctype="multipart/form-data">
                    @include('colaborador.form-colaborador')
                </form>
                <hr>
            </div>
        </div>
        <div class="tab-pane fade" id="veiculo" role="tabpanel" aria-labelledby="veiculo-tab">
            <div id="PrimeiroVeiculo">
                <header class="h1">Cadastre o primeiro veículo</header>
                <form action="{{ route('veiculo.store') }}" name="FormVeiculo" method="post"
                    enctype="multipart/form-data">
                    @include('veiculo.form-veiculo')
                </form>
                <hr>
            </div>
        </div>
        <div class="tab-pane fade" id="cliente" role="tabpanel" aria-labelledby="cliente-tab">
            <div id="PrimeiroCliente">
                <header class="h1">Cadastre o primeiro cliente</header>
                <form action="{{ route('clientes.store') }}" name="FormCliente" method="post">
                    @include('cliente.form-cliente')
                </form>
                <hr>
            </div>
        </div>
        <div class="tab-pane fade" id="fornecedor" role="tabpanel" aria-labelledby="fornecedor-tab">
            <div id="PrimeiroFornecedor">
                <header class="h1">Cadastre o primeiro fornecedor</header>
                <form action="{{ route('fornecedor.store') }}" name="FormFornecedor" method="post"
                    enctype="multipart/form-data">
                    @include('fornecedor.form')
                </form>
                <hr>
            </div>
        </div>
        <div class="tab-pane fade" id="fiscal" role="tabpanel" aria-labelledby="fiscal-tab">
            Informacoes fiscal para emissao de documentos
            <ul>
                <li>Certificado digital</li>
                <li>Tributacao</li>
                <li>Ambiente Fiscal</li>
                <li>Prox numeracao, serie e versao de cte e mdfe</li>
            </ul>
        </div>
    </div>
    <footer>
        <a href="" class="btn btn-danger m-2">Fechar</a>
    </footer>
</div>
