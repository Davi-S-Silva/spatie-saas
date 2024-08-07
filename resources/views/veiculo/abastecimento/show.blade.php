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
                    {{-- <pre>
                    {{ print_r($abastecimento->getAttributes()) }}
                    </pre> --}}
                    {{ $abastecimento->cupom }}
                    {{ $abastecimento->colaborador->name }}
                    {{ $abastecimento->veiculo->placa }}
                    {{ $abastecimento->combustivel->name }}
                    {{ $abastecimento->fornecedor->name }}
                    R${{ number_format($abastecimento->valor, 2, ',', '.') }}
                    {{ number_format($abastecimento->litros, 2, ',', '.') }}L
                    {{ $abastecimento->kmAnterior }}
                    {{ $abastecimento->kmAtual }}


                    <div class="d-flex justify-around align-items-center text-center">
                        <figure>
                             {{ $abastecimento->pathFotoCupom }}
                            {{-- {{ Storage::temporaryUrl($abastecimento->pathFotoCupom, now()->addHour(1)) }}
                            <img src="{{ Storage::temporaryUrl($abastecimento->pathFotoCupom, now()->addHour(1)) }}"
                                alt="Foto do Cupom">
                            <figcaption>
                                Foto do Cupom
                            </figcaption>
                        </figure>
                        <figure>
                            <img src="{{ Storage::temporaryUrl($abastecimento->pathFotoHodometro, now()->addHour(1)) }}"
                                alt="Foto do Hodometro">
                            <figcaption>
                                Foto do Hodometro
                            </figcaption>
                        </figure>
                        <figure>
                            <img src="{{ Storage::temporaryUrl($abastecimento->pathFotoBomba, now()->addHour(1)) }}"
                                alt="Foto do Bomba Abastecimento">
                            <figcaption>
                                Foto da bomba de combustivel
                            </figcaption> --}}
                        </figure>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
