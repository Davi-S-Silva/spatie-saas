<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Monitorando Todos os Veículos') }}
        </h2>
    </x-slot>
    <div class="py-1">
        <div class="mx-auto px-1">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="card col-12 p-2">
                    <section>
                        <div id="mapAll"></div>
                        <div class="monitorar_todos_veiculo">
                            <section id="AreaDadosAjaxMonitoramento" class="d-flex flex-wrap justify-around col-12"></section>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
