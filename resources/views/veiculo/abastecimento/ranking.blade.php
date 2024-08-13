<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ranking das Médias') }}
        </h2>
    </x-slot>
    <div class="py-1">
        <div class=" mx-auto px-1">
            <div class=" overflow-hidden shadow-sm sm:rounded-lg">
                <div class="col-12 p-0 card_abastecimento">
                    {{-- <form action="{{ route('abastecimento.update') }}" name="FormAbastecimento" method="post" enctype="multipart/form-data">
                        @include('veiculo.abastecimento.form-abastecimento')
                    </form> --}}

                    <header class="col-12 d-flex justify-center align-items-center">
                        <div class="col-5 header_ranking" style="background-image: url('{{ asset('img/pista.png') }}');">
                            {{-- &ThinSpace; --}}
                        </div>
                        <figure>
                            <img src="{{ asset('img/ranking.png') }}" alt="">
                        </figure>
                        <div class="col-5 header_ranking"
                            style="background-image: url('{{ asset('img/pista.png') }}');">
                            {{-- &ThinSpace; --}}
                        </div>
                    </header>
                    {{-- <div class="d-flex flex-column col-12 p-2 align-items-center text-center" id="rolavel"> --}}
                    {{-- <div id="fixo"> --}}
                        <div class="d-flex col-12 p-2 justify-around overflow-scroll flex-wrap text-center"  id="rolavel">
                            {{-- CARRETA --}}
                            <div class="col-5 m-3 bg-transparent-ranking-media">
                                <header>Carreta</header>
                                <table class="text-center p-0 m-0 col-12">
                                    <thead class="col-12">
                                        <tr class="d-flex align-items-center justify-around col-12 p-0 m-0">
                                            <td class="w-20 p-0 ">-</td>
                                            <td class="col-6">MOTORISTA</td>
                                            <td class="col-2">VEÍCULO</td>
                                            <td class="w-20 px-1">MÉDIA</td>
                                            {{-- <td class="w-20 px-1">TOTAL</td> --}}
                                        </tr>
                                    </thead>
                                    <tbody class="col-12">
                                        @php
                                            $i = 1;
                                        @endphp
                                        @foreach ($Abastecimentos as $abastecimento)
                                            @if ($abastecimento->veiculo->tipo_veiculo_id == 43)
                                                <tr class="d-flex align-items-center justify-around col-12 p-0 m-0">
                                                    <td class="w-20 p-0"><span
                                                            class="bg_badg_ranking rounded-pill w-20 p-0 text-yellow-400 font-extrabold text-2xl">{{ $i }}</span>
                                                    </td>
                                                    <td class="col-6"><span
                                                            class="bg_badg_ranking rounded-pill overflow-hidden ">{{ strtoupper($abastecimento->colaborador->name) }}</span>
                                                    </td>
                                                    <td class="col-2"><span
                                                            class="bg_badg_ranking rounded-pill">{{ strtoupper($abastecimento->veiculo->placa) }}</span>
                                                    </td>
                                                    {{-- <td class="col-1"><span class="bg_badg_ranking rounded-pill">{{ $abastecimento->media }}</span></td> --}}
                                                    <td class="w-20 px-1"><span
                                                            class="bg_badg_ranking rounded-pill w-20 bg-yellow-400 text-black font-bold px-1">{{ number_format($abastecimento->media, 2, ',', '.') }}</span>
                                                    </td>
                                                </tr>
                                                @php
                                                    $i++;
                                                @endphp
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            {{-- TRUCK --}}
                            <div class="col-5 m-3 bg-transparent-ranking-media">
                                <header>Truck</header>
                                <table class="text-center p-0 m-0 col-12">
                                    <thead class="col-12">
                                        <tr class="d-flex align-items-center justify-around col-12 p-0 m-0">
                                            <td class="w-20 p-0 ">-</td>
                                            <td class="col-6">MOTORISTA</td>
                                            <td class="col-2">VEÍCULO</td>
                                            <td class="w-20 px-1">MÉDIA</td>
                                            {{-- <td class="w-20 px-1">TOTAL</td> --}}
                                        </tr>
                                    </thead>
                                    <tbody class="col-12">
                                        @php
                                            $i = 1;
                                        @endphp
                                        @foreach ($Abastecimentos as $abastecimento)
                                            @if ($abastecimento->veiculo->tipo_veiculo_id == 45)
                                                <tr class="d-flex align-items-center justify-around col-12 p-0 m-0">
                                                    <td class="w-20 p-0"><span
                                                            class="bg_badg_ranking rounded-pill w-20 p-0 text-yellow-400 font-extrabold text-2xl">{{ $i }}</span>
                                                    </td>
                                                    <td class="col-6"><span
                                                            class="bg_badg_ranking rounded-pill overflow-hidden ">{{ strtoupper($abastecimento->colaborador->name) }}</span>
                                                    </td>
                                                    <td class="col-2"><span
                                                            class="bg_badg_ranking rounded-pill">{{ strtoupper($abastecimento->veiculo->placa) }}</span>
                                                    </td>
                                                    {{-- <td class="col-1"><span class="bg_badg_ranking rounded-pill">{{ $abastecimento->media }}</span></td> --}}
                                                    <td class="w-20 px-1"><span
                                                            class="bg_badg_ranking rounded-pill w-20 bg-yellow-400 text-black font-bold px-1">{{ number_format($abastecimento->media, 2, ',', '.') }}</span>
                                                    </td>
                                                </tr>
                                                @php
                                                    $i++;
                                                @endphp
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            {{-- TOCO --}}
                            <div class="col-5 m-3 bg-transparent-ranking-media">
                                <header>Toco</header>
                                <table class="text-center p-0 m-0 col-12">
                                    <thead class="col-12">
                                        <tr class="d-flex align-items-center justify-around col-12 p-0 m-0">
                                            <td class="w-20 p-0">-</td>
                                            <td class="col-6">MOTORISTA</td>
                                            <td class="col-2">VEÍCULO</td>
                                            <td class="w-20 px-1">MÉDIA</td>
                                            {{-- <td class="w-20 px-1">TOTAL</td> --}}
                                        </tr>
                                    </thead>
                                    <tbody class="col-12">
                                        @php
                                            $i = 1;
                                        @endphp
                                        @foreach ($Abastecimentos as $abastecimento)
                                            @if ($abastecimento->veiculo->tipo_veiculo_id == 41)
                                                <tr class="d-flex align-items-center justify-around col-12 p-0 m-0">
                                                    <td class="w-20 p-0"><span
                                                            class="bg_badg_ranking rounded-pill w-20 p-0 text-yellow-400 font-extrabold text-2xl">{{ $i }}</span>
                                                    </td>
                                                    <td class="col-6"><span
                                                            class="bg_badg_ranking rounded-pill overflow-hidden ">{{ strtoupper($abastecimento->colaborador->name) }}</span>
                                                    </td>
                                                    <td class="col-2"><span
                                                            class="bg_badg_ranking rounded-pill">{{ strtoupper($abastecimento->veiculo->placa) }}</span>
                                                    </td>
                                                    {{-- <td class="col-1"><span class="bg_badg_ranking rounded-pill">{{ $abastecimento->media }}</span></td> --}}
                                                    <td class="w-20 px-1"><span
                                                            class="bg_badg_ranking rounded-pill w-20 bg-yellow-400 text-black font-bold px-1">{{ number_format($abastecimento->media, 2, ',', '.') }}</span>
                                                    </td>
                                                </tr>
                                                @php
                                                    $i++;
                                                @endphp
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div> {{-- div id rolavel --}}
                    {{-- </div>  --}}
                    {{-- div id fixo --}}

                    <footer class="col-12 header_ranking card_abastecimento"
                        style="background-image: url('{{ asset('img/pista.png') }}');"></footer>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
