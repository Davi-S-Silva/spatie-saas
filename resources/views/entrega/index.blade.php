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
                    {{-- @foreach ($clientes as $cliente)
                        <ul>
                            <li><b><a href="{{ route('clientes.show',['cliente'=>$cliente->id]) }}">{{ $cliente->name }}</b></a>
                                <ul>
                                    @forelse ($cliente->filials as $filial)
                                       <li>{{ $filial->razao_social }}</li>
                                    @empty
                                        <li>nenhum filial cadastrada</li>
                                    @endforelse
                                </ul>
                                <a class="btn btn-primary" href="{{ route('filial.create',['cliente'=>$cliente->id]) }}">Nova Filial</a>
                            </li>
                        </ul>
                    @endforeach --}}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
