@php
use App\Models\Uteis;
@endphp

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
                    <div class="d-flex col-12 justify-between">
                        <div veiculo="{{ $veiculo }}" class="monitorar_veiculo col-3">
                            <section id="AreaDadosAjaxMonitoramento"></section>
                        </div>
                        <div id="map"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

