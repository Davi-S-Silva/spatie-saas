<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Clientes') }}
        </h2>
    </x-slot>
    <div class="py-1">
        <div class="mx-auto px-1">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="card col-12 p-2">
                    @foreach ($clientes as $cliente)
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
                                <form action="{{ route('frete-cliente.store') }}" method="post" name="FormFreteCliente" class="d-flex align-items-center my-2">
                                    <input type="hidden" name="cliente" value="{{ $cliente->id }}">
                                    <select name="FreteCliente" id="" required class="mr-2">
                                        <option value="">Selecione um Modelo de frete para o cliente</option>
                                        @foreach ($fretes as $item)
                                        @if ($cliente->frete()->count()!=0 && $cliente->frete->first()->id == $item->id)
                                            <option value="{{ $item->id }}" selected>{{ $item->name }} - {{ $item->descricao }}</option>
                                        @else
                                            <option value="{{ $item->id }}">{{ $item->name }} - {{ $item->descricao }}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                    @csrf
                                    <div>
                                        <input type="submit" value="Salvar Modelo de Frete Cliente" class="btn btn-primary">
                                    </div>
                                </form>
                            </li>
                        </ul>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
