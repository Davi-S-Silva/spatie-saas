<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Show Abastecimento') }}
        </h2>
    </x-slot>
    <div class="py-1">
        <div class="mx-auto px-1">
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
                    {{ date('d/m/Y H:i:s', strtotime($abastecimento->created_at)) }}
                    R${{ number_format($abastecimento->valor, 2, ',', '.') }}
                    {{ number_format($abastecimento->litros, 2, ',', '.') }}L
                    {{ $abastecimento->kmAnterior }}
                    {{ $abastecimento->kmAtual }}

                    {{-- d-flex justify-around align-items-center text-center --}}
                    <div class="area_show_abastecimento d-flex flex-wrap">
                        <figure>
                             {{-- {{ $abastecimento->pathFotoCupom }} --}}
                            {{-- {{ Storage::temporaryUrl($abastecimento->pathFotoCupom, now()->addHour(1)) }} --}}
                            <figcaption>
                                Foto do Cupom
                            </figcaption>
                            <img src="{{ (getenv('FILESYSTEM_DISK')=='s3')?Storage::temporaryUrl($abastecimento->pathFotoCupom, now()->addHour(1)):asset('img/cupom.jpg') }}"
                                alt="Foto do Cupom">
                        </figure>
                        <figure>
                            <figcaption>
                                Foto do Hodometro
                            </figcaption>
                            <img src="{{ (getenv('FILESYSTEM_DISK')=='s3') ? Storage::temporaryUrl($abastecimento->pathFotoHodometro, now()->addHour(1)) : asset('img/hodometro.jpg') }}"
                                alt="Foto do Hodometro">
                        </figure>
                        <figure>
                            <figcaption>
                                Foto da bomba de combustivel
                            </figcaption>
                            <img src="{{ (getenv('FILESYSTEM_DISK')=='s3')?Storage::temporaryUrl($abastecimento->pathFotoBomba, now()->addHour(1)):asset('img/bomba.jpg') }}"
                                alt="Foto do Bomba Abastecimento">
                        </figure>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
