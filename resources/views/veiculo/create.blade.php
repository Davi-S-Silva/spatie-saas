<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Veículo') }}
        </h2>
    </x-slot>
    <div class="py-1">
        <div class="max-w-7xl mx-auto px-1">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="card col-12 p-2">
                    <form action="{{ route('veiculo.store') }}" method="post" enctype="multipart/form-data">
                        @include('veiculo.form-veiculo')
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
