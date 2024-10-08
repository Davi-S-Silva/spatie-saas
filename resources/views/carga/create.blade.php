<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Carga') }}
        </h2>
    </x-slot>
    <div class="py-1">
        <div class="mx-auto px-1">
            <x-set-notas-carga />
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="card col-12 p-2">
                    <form action="" method="post" name="FormNovaCarga" enctype="multipart/form-data">
                        @include('carga.form')
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
