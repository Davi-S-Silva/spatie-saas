<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Comprovantes Carga') }}
        </h2>
    </x-slot>
    <div class="py-1">
        <div class="mx-auto px-1">
            <div class="overflow-hidden shadow-sm sm:rounded-lg">
                <div class="card col-12 p-2">
                    <div class="print_lista_comprovantes_notas_carga">
                        <header class="text-center font-bold my-2">Listagem de Comprovantes de Pagamento - AS
                            {{ $carga->os }} - Remessa {{ $carga->remessa }} </header>
                        <div class="d-flex flex-wrap justify-around">
                            @if ($semTaNoBd==false)
                                @foreach ($notas as $nota)
                                    @if (in_array($nota->tipo_pagamento_id, $pagamentos) || ($nota->indicacao_pagamento_id = 1))
                                        @if ($nota->comprovantes()->get()->count() != 0)
                                            @foreach ($nota->comprovantes as $comprovante)
                                                <figure class="col-3 m-2 bg-success">
                                                    <img src="{{ $nota->getComprovante($comprovante->path) }}"
                                                        alt="">
                                                        @php
                                                        $explode = explode('.',$comprovante->path);
                                                        $textPath = explode('/',$explode[0]);
                                                        $stringNota = explode('_',end($textPath));
                                                    @endphp
                                                    <figcaption class="text-center">{{ $stringNota[0] }}</figcaption>
                                                </figure>
                                            @endforeach
                                        @else
                                            @php
                                                $path = $nota->getComprovanteNotaSemTaNoBd();
                                            @endphp
                                            @if (!empty($path))
                                            <figure class="col-3 m-2 bg-danger">
                                                <img src="{{ $path }}" alt="">
                                                @php
                                                    $explode = explode('.',$path);
                                                    $textPath = explode('/',$explode[0]);
                                                    $stringNota = explode('_',end($textPath));
                                                @endphp
                                                <figcaption class="text-center">{{ $stringNota[0] }}</figcaption>
                                            </figure>
                                            @endif
                                        @endif
                                    @endif
                                @endforeach
                            @endif
                        </div>
                        <footer class="text-center font-bold my-2">
                            Relatorio emitido por: {{ Auth::user()->name }} - Empresa:
                            {{ Auth::user()->empresa->first()->nome_fantasia }}
                        </footer>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
