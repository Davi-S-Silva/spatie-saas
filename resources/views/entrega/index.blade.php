<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Entregas') }}
        </h2>
    </x-slot>
    <div class="py-1">
        <div class="max-w-7xl mx-auto px-1">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="card col-12 p-2">
<<<<<<< HEAD
                    {{-- @foreach ($clientes as $cliente)
                        <ul>
                            <li><b><a href="{{ route('clientes.show',['cliente'=>$cliente->id]) }}">{{ $cliente->name }}</b></a>
=======
                    @foreach ($entregas as $entrega)
                        <ul>
                            <li class="mb-3">
                                {{-- <b><a href="{{ route('clientes.show',['cliente'=>$cliente->id]) }}">{{ $cliente->name }}</b></a> --}}
>>>>>>> c29e677dddec127181733d44fcdbe30fb53ba128
                                <ul>
                                    <li class="p-2 bg-slate-100">
                                        <header class="d-flex justify-content-between">
                                            <div><b>Motorista: </b>{{ $entrega->colaborador->name }}</div>
                                            <div><b>Veiculo: </b>{{ $entrega->veiculo->placa }}</div>
                                            <div><b>Ajudantes: </b>
                                                @php
                                                    $i=0;
                                                @endphp
                                                @forelse ( $entrega->ajudantes as $ajudante )
                                                {{ $ajudante->name }}
                                                @php
                                                    if($i<count($entrega->ajudantes)-1){
                                                        echo ',';
                                                    }
                                                    $i++;
                                                @endphp
                                                @empty
                                                    Não há ajudantes
                                                @endforelse


                                            </div>
                                            <div>
                                                <b>Status: </b>{{ $entrega->status() }}
                                            </div>
                                        </header>
                                            <ul class="px-3">
                                            @foreach ($entrega->cargas as $item)
                                                <li><b>Remessa: </b>{{ $item->remessa }} <b>OS: </b>{{ $item->os }} <b>Motorista OS: </b>{{ $item->motorista->name }} <b>Área: </b>{{ $item->area }}</li>
                                            @endforeach
                                            </ul>
                                    </li>
                                </ul>
                                {{-- <a class="btn btn-primary" href="{{ route('filial.create',['cliente'=>$cliente->id]) }}">Nova Filial</a> --}}
                            </li>
                        </ul>
                    @endforeach

                    <div>{{ $entregas->links() }}</div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
