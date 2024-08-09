{{-- @php
    use App\Models\Manutencao;
@endphp --}}

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manutenções') }}
        </h2>
    </x-slot>
    <div class="py-1">
        <div class="max-w-7xl mx-auto px-1">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="card col-12 p-2">
                    <pre>
                    @foreach ($manutencoes as $manutencao)
                        {{ print_r($manutencao->getAttributes()) }}
                        @foreach ($manutencao->servicos()->get() as $servico)
                        {{ print_r($servico->getAttributes()) }}
                        @endforeach
                        @foreach ($manutencao->observacoes()->get() as $obs)
                        {{ print_r($obs->getAttributes()) }}
                        @endforeach
                    @endforeach
                    </pre>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
