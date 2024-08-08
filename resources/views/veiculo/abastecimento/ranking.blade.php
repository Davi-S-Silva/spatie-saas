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
                    <table class="text-center p-0 m-0 col-12">
                        <thead class="col-12">
                            <tr class="d-flex align-items-center justify-center col-12 p-0 m-0">
                                <td class="col-1">-</td>
                                <td class="col-2">MOTORISTA</td>
                                <td class="col-1">VEÍCULO</td>
                                <td class="w-20 px-1">MÉDIA</td>
                                {{-- <td class="w-20 px-1">TOTAL</td> --}}
                            </tr>
                        </thead>
                        <tbody class="col-12">
                            @php
                                $i=1;
                            @endphp
                            @foreach ($abastecimentos as $abastecimento)
                                <tr class="d-flex align-items-center justify-center col-12 p-0 m-0">
                                    <td class="col-1"><span class="bg_badg_ranking rounded-pill w-20 py-0 px-1 text-yellow-400 font-extrabold text-3xl">{{ $i }}</span></td>
                                    <td class="col-2"><span class="bg_badg_ranking rounded-pill overflow-hidden ">{{ strtoupper($abastecimento->colaborador->name) }}</span></td>
                                    <td class="col-1"><span class="bg_badg_ranking rounded-pill">{{ strtoupper($abastecimento->veiculo->placa) }}</span></td>
                                    {{-- <td class="col-1"><span class="bg_badg_ranking rounded-pill">{{ $abastecimento->media }}</span></td> --}}
                                    <td class="w-20 px-1"><span class="bg_badg_ranking rounded-pill w-20 bg-yellow-400 text-black font-bold px-1">{{ number_format($abastecimento->media,2,',','.') }}</span></td>
                                </tr>
                                @php
                                    $i++;
                                @endphp
                            @endforeach
                        </tbody>
                    </table>
                    <footer class="col-12 header_ranking card_abastecimento" style="background-image: url('{{ asset('img/pista.png') }}');"></footer>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
