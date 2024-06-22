<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Nova Entrega') }}
        </h2>
    </x-slot>
    <div class="py-1">
        <div class="max-w-7xl mx-auto px-1">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="card col-12 p-2">
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
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
