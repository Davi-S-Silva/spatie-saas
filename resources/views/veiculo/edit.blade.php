<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Veículo') }}
        </h2>
    </x-slot>
    <div class="py-1">
        <div class="mx-auto px-1">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="card col-12 p-2">
                    {{-- <pre>
                        {{ print_r($veiculo->getAttributes())}}
                    </pre> --}}
                    <form action="{{ route('veiculo.update',['veiculo'=>$veiculo->id]) }}" name="FormVeiculoEdit" method="post" enctype="multipart/form-data">
                        @method('PUT')
                    @include('veiculo.form-veiculo')
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
