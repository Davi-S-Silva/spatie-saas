<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Veículo') }}
        </h2>
    </x-slot>
    <div class="py-1">
        <div class="mx-auto px-1">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="card col-12 p-2">
                    {{-- <pre>
                        {{ print_r($veiculo->getAttributes())}}
                    </pre> --}}
                    @include('veiculo.form-veiculo',['disabled'=>'disabled'])
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
