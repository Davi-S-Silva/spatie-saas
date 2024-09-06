<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Novo Cte') }}
        </h2>
    </x-slot>
    <div class="py-1">
        <div class="mx-auto sm:px-1 lg:px-1">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-2">
                <form action="" method="post">
                    @include('fiscal.cte.form')
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
