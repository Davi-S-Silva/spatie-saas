<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Frete') }}
        </h2>
    </x-slot>
    <div class="py-1">
        <div class="mx-auto px-1">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="card col-12 p-2">
                   Modelos de fretes disponivel para uso no sistema
                    <ul>
                        @foreach ($fretes as $item)
                            <li>{{ str_replace('-',' ',$item->name) }} - {{ $item->descricao }} - <a href="{{ route('frete.edit',['frete'=>$item->id]) }}">Editar</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
