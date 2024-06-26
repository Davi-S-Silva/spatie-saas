<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Veículos') }}
        </h2>
    </x-slot>
    <div class="py-1">
        <div class="max-w-7xl mx-auto px-1">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="card col-12 p-2">
                    {{-- <form action="{{ route('veiculo.store') }}" method="post" enctype="multipart/form-data">
                        @include('colaborador.form-colaborador')
                    </form> --}}
                    <ul>

                        @forelse ($veiculos as $veiculo)
                            <li><a href="{{ route('veiculo.show',['veiculo'=>$veiculo->id]) }}">{{ $veiculo->placa }}</a>
                                @if ($veiculo->clientes->first())
                                    {{ $veiculo->clientes->first()->filials()->first()->razao_social }}
                                    <a href="{{ route('mudarVeiculoDeCliente',['cliente'=>2,'veiculo'=>$veiculo->id]) }}">Alterar de cliente</a>
                                @endif
                            </li>
                        @empty
                        <li>
                            não há veiculo cadastrado
                        </li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
