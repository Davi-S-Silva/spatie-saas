<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Colaboradores') }}
        </h2>
    </x-slot>
    <div class="py-1">
        <div class="max-w-7xl mx-auto px-1">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="card col-12 p-2">
                    @foreach ($Colaboradores as $colaborador)
                        <ul>
                            <li><a href="{{ route('colaboradores.show',['colaboradore'=>$colaborador->id]) }}">{{ $colaborador->name }}</a>
                                <ul>
                                    @foreach ($colaborador->contatos as $contato)
                                        <li>{{ $contato->celular }}</li>
                                    @endforeach
                                </ul>
                            </li>
                        </ul>
                        <b>{{ $colaborador->localApoio->name }}</b>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
