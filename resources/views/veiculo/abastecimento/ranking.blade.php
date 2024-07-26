<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Show Abastecimento') }}
        </h2>
    </x-slot>
    <div class="py-1">
        <div class="max-w-7xl mx-auto px-1">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="card col-12 p-2">
                    {{-- <form action="{{ route('abastecimento.update') }}" name="FormAbastecimento" method="post" enctype="multipart/form-data">
                        @include('veiculo.abastecimento.form-abastecimento')
                    </form> --}}
                  <ul>
                   @foreach ($abastecimentos as $abastecimento)
                      <li> {{ $abastecimento->colaborador->name }} - {{ $abastecimento->media }}</li>
                      {{-- <li>  {{ $abastecimento->media }}</li> --}}
                   @endforeach
                </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
