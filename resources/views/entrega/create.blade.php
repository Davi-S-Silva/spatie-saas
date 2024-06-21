<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
<<<<<<< HEAD
            {{ __('Entregas') }}
=======
            {{ __('Nova Entrega') }}
>>>>>>> 506fcbab70c9ebb8befefd76a798fab567186cf2
        </h2>
    </x-slot>
    <div class="py-1">
        <div class="max-w-7xl mx-auto px-1">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="card col-12 p-2">
<<<<<<< HEAD
                    <form action="{{ route('entrega.store') }}" name="FormEntrega" method="post">
                        @include('entrega.form-entrega')
                    </form>
=======
                    @foreach ($clientes as $cliente)
                        <ul>
                            {{-- <li><b><a href="{{ route('clientes.show',['cliente'=>$cliente->id]) }}">{{ $cliente->name }}</b></a> --}}
                                <ul>
                                    @foreach ( $cliente->filials as $filial )
                                        <li><a href="{{route('carga.getCargasDisponiveis',['filial'=>$filial->id])}}">{{ $filial->razao_social }}</a></li>
                                    @endforeach
                                </ul>
                            </li>
                        </ul>
                    @endforeach
>>>>>>> 506fcbab70c9ebb8befefd76a798fab567186cf2
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
