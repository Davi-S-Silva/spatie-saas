<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Monitorando Veículo') }} - {{ $veiculo }}
        </h2>
    </x-slot>
    <div class="py-1">
        <div class="mx-auto px-1">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="card col-12 p-2">
                   <div veiculo="{{ $veiculo }}" class="monitorar_veiculo">
                    <section id="AreaDadosAjaxMonitoramento"></section>
                   </div>
                   {{-- <embed type="" src="" width="250" height="200" /> --}}
                   <iframe src="https://www.openstreetmap.org/directions?engine=fossgis_osrm_car&route=-8.11384%2C-34.91542%3B-8.11085%2C-34.98205#map=14/-8.1027/-34.9601&layers=N" width="300" height="300">
                    <p>Your browser does not support iframes.</p>
                  </iframe>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
