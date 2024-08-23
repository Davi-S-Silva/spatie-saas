<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Entrega') }} {{ $entrega->id }}
        </h2>
    </x-slot>
    <div class="py-1">
        <div class="mx-auto px-1">
            <div id="AcoesEntrega" class="d-flex flex-column p-0 m-0">
                <button class="btn btn-danger submit_entrega" name="Devolver">Devolver</button>
                <button class="btn btn-success submit_entrega" name="Receber">Receber</button>
                <button class="btn btn-info submit_entrega" name="Calcular">Calcular</button>
                {{-- <input class="btn btn-danger" value="Devolver"/>
                <input class="btn btn-success" value="Receber"/>
                <input class="btn btn-info" value="Calcular"/> --}}
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <x-start-entrega />
                <x-stop-entrega :localMovimentacao=$localMovimentacao />
                <div class="card col-12 p-2 exibe_entrega">
                    <form action="{{ route('receberVariasNotas', ['entrega' => $entrega->id]) }}" method="post"
                        name="FormEncerraEntrega">
                        <header>
                            @if ($entrega->status_id == $entrega->getStatusId('Pendente'))
                                <a href="{{ route('entrega.start', ['entrega' => $entrega->id]) }}"
                                    id="Start_Ent_{{ $entrega->id }}"
                                    class="text-green-600 btn btn-outline-success start_entrega m-2"
                                    entrega="{{ $entrega->id }}" mot="{{ $entrega->colaborador_id }}"><i
                                        class="fa-solid fa-play"></i></a>
                            @endif
                            @if ($entrega->status_id == $entrega->getStatusId('Rota'))
                                <a href="{{ route('entrega.stop', ['entrega' => $entrega->id]) }}"
                                    id="Stop_Ent_{{ $entrega->id }}"
                                    class="text-red-600 btn btn-outline-danger stop_entrega  m-2"
                                    entrega="{{ $entrega->id }}" mot="{{ $entrega->colaborador_id }}"><i
                                        class="fa-solid fa-stop"></i></a>
                            @endif
                            <ul>
                                <li>Motorista: <b>{{ $entrega->colaborador->name }}</b></li>
                                <li>Ajudantes: <b>
                                        @forelse ($entrega->ajudantes as $ajudante)
                                            {{ $ajudante->name }}
                                        @empty
                                            Não há ajudantes
                                        @endforelse
                                    </b></li>
                                <li>Veiculo: <b>{{ $entrega->veiculo->placa }}</b></li>
                                @php
                                    $kmInicio = (isset($entrega->movimentacao->kmInicio))?$entrega->movimentacao->kmInicio->km:0;
                                    $kmFim = (isset($entrega->movimentacao->kmFim))?$entrega->movimentacao->kmFim->km:0;
                                    $kmPercorrido = ($kmFim-$kmInicio);
                                @endphp
                                <li>Km Inicio: <b>{{ $kmInicio }}</b></li>
                                <li>Km Fim: <b>{{ ($kmFim!=0)?$kmFim:'---' }}</b></li>
                                <li>Km Percorrido: <b>{{ ($kmPercorrido>0 )?$kmPercorrido:'---' }}</b></li>
                            </ul>
                        </header>
                        <section>

                            @forelse ($entrega->cargas()->get() as $carga)
                                <article>
                                    <header>
                                        <ul>
                                            <li>OS: <b>{{ $carga->os }}</b></li>
                                            <li>Remessa: <b>{{ $carga->remessa }}</b></li>
                                            <li>Paradas: <b>{{ count($carga->paradas()) }}</b></li>
                                        </ul>
                                    </header>
                                    Notas
                                    <hr />
                                    <section class="d-flex flex-wrap justify-around col-12 ">
                                        @forelse ($carga->notas()->with('destinatario','carga')->orderBy('destinatario_id','asc')->get() as $nota)
                                            <div class="col-lg-3 col-11 mx-1 d-flex justify-around align-items-center">
                                                <x-nota :nota=$nota />
                                            </div>
                                        @empty
                                            não tem notas
                                        @endforelse
                                    </section>
                                    <footer>
                                        {{-- fim carga --}}
                                        <hr />
                                    </footer>
                                </article>
                            @empty
                                Não há cargas
                            @endforelse
                        </section>
                        <footer>
                            {{-- fim entrega --}}

                            @csrf
                            {{-- <input type="submit" value="Encerrar Entrega" class="btn btn-primary" name="EncerrarEntrega"> --}}
                            @if ($entrega->status_id == $entrega->getStatusId('Rota'))
                            <a href="{{ route('entrega.stop', ['entrega' => $entrega->id]) }}"
                                id="Start_Ent_{{ $entrega->id }}"
                                class="text-red-600 btn btn-outline-danger stop_entrega  m-2"
                                entrega="{{ $entrega->id }}" mot="{{ $entrega->colaborador_id }}">Encerrar
                                Entrega</a>
                                @endif
                        </footer>
                    </form>
                    <div id="mapEntrega" class="monitorar_entrega" entrega="{{ $entrega->id }}"></div>
                </div>
            </div>
        </div>
    </div>
    <section id="AreaResultados" class="col-10">
        <div id="Resultados" class="col-sm-2 col-10">
            <header class="d-flex justify-between align-items-center p-3">
                <div>Resultados</div>
                <div class="m-2 cursor-pointer close_modal"><i class="fa-regular fa-rectangle-xmark"></i></div>
            </header>
            <div id="Content" class="py-3 px-5">
                <ul>
                    <li class="pesoLiquido"></li>
                    <li class="pesoBruto"></li>
                    <li class="valor"></li>
                    <li class="volume"></li>
                    <li class="qtdnotas"></li>
                </ul>
                <ul class="lista-resposta-calculo d-flex flex-wrap">

                </ul>
            </div>
        </div>
    </section>
</x-app-layout>
