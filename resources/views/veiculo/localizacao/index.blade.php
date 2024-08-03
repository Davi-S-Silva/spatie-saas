<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Localização') }}
        </h2>
    </x-slot>
    <div class="py-1">
        <div class="max-w-7xl mx-auto px-1">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="card col-12 p-2">
                    {{-- <pre> --}}
                        {{ count($locations) }} veículos
                    <section class="d-flex flex-wrap justify-around col-12">
                        @foreach ($locations as $item)
                            {{-- {{ print_r($item) }} --}}
                            <x-card-location :item=$item />
                        @endforeach
                    </section>
                    {{-- </pre> --}}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
