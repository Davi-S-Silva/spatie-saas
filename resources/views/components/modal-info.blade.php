<div class="area-modal-info">
    <header>
        <h1 class="h3 text-center py-2">{{ $title }}</h1>
        <hr />
    </header>
    <div>
        {{-- {{ $text }} --}}
        @if (isset($veiculos) && $veiculos==0)
        <div id="PrimeiroVeiculo">
            <header class="h1">Cadastre o primeiro veículo</header>
            <form action="{{ route('veiculo.store') }}" name="FormVeiculo" method="post" enctype="multipart/form-data">
                @include('veiculo.form-veiculo')
            </form>
            <hr>
        </div>
        @endif

        @if (isset($colaboradores) && $colaboradores==0)
        <div id="PrimeiroColaborador">
            <header class="h1">Cadastre o primeiro colaborador</header>
            <form action="{{ route('colaboradores.store') }}" name="FormColaborador"  method="post" enctype="multipart/form-data">
                @include('colaborador.form-colaborador')
            </form>
            <hr>
        </div>
        @endif

        @if (isset($clientes) && $clientes==0)
        <div id="PrimeiroCliente">
            <header class="h1">Cadastre o primeiro cliente</header>
            <form action="{{ route('clientes.store') }}" name="FormCliente" method="post">
                @include('cliente.form-cliente')
            </form>
            <hr>
        </div>
        @endif


    </div>
    <footer>
        {{-- <hr> --}}
        {{-- <a href="{{ route($link) }}" class="btn-simple">link</a> --}}

        <a href="" class="btn btn-danger m-2">Fechar</a>
    </footer>
</div>
