<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Localização') }}
        </h2>
    </x-slot>
    <div class="py-1">
        <div class="mx-auto px-1">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="card col-12 p-2">
                    {{-- <pre> --}}

<h1>Localização Veiculo</h1>
<pre>{{ print_r($veiculo) }}</pre>
                    {{-- </pre> --}}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

