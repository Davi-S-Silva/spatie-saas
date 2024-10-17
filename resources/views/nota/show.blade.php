<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Show Nota') }}
        </h2>
    </x-slot>
    <div class="py-1">
        <div class="mx-auto sm:px-1 lg:px-1">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-2">
            <pre>
                {{ print_r($nota->getAttributes()) }}
                <a href="{{ route('carga.show',['carga'=>$nota->carga->id]) }}">{{ $nota->carga->os }}</a>
            </pre>
            </div>
        </div>
    </div>
</x-app-layout>
