<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Entregas') }}
        </h2>
    </x-slot>
    <div class="py-1">
        <div class="mx-auto px-1">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="card col-12 p-2">
                    <x-start-entrega />
                    <x-stop-entrega :localMovimentacao=$localMovimentacao />
                    <ul class="index_entrega col-12">
                        <li class=" col-12">
                            <ul class="title_index_entrega col-12">
                                <li class=" col-md-2 col-12">Motorista</li>
                                <li class=" col-md-2 col-12">Veiculo</li>
                                <li class=" col-md-2 col-12">Ajudante</li>
                                <li class=" col-md-2 col-12">Status</li>
                                <li class=" col-md-2 col-12">Ação</li>
                            </ul>
                            @foreach ($entregas as $entrega)
                            <ul class="ul_principal_index_entrega col-12">
                                <li class=" col-md-2 col-12"> <span class="title_index_entrega_mobile">Motorista</span>{{ $entrega->colaborador->name }}</li>
                                <li class=" col-md-2 col-12"> <span class="title_index_entrega_mobile">Veículo</span>{{ $entrega->veiculo->placa }}</li>
                                <li class=" col-md-2 col-12">
                                    <ul class="pl-1">  <span class="title_index_entrega_mobile">Ajudante</span>
                                        @forelse ($entrega->ajudantes as $ajudante)
                                            <li>{{ $ajudante->name }}</li>
                                        @empty
                                            Não há ajudante
                                        @endforelse
                                    </ul>
                                </li>
                                <li class=" col-md-2 col-12"> <span class="title_index_entrega_mobile">Status</span>{{ $entrega->getStatus->descricao }}</li>
                                <li class=" col-md-2 col-12"> <span class="title_index_entrega_mobile">Ação</span>
                                    <div>
                                        @if ($entrega->status_id == $entrega->getStatusId('Pendente'))
                                            <a href="{{ route('entrega.start', ['entrega' => $entrega->id]) }}"
                                                id="Start_Ent_{{ $entrega->id }}"
                                                class="text-green-600 btn btn-outline-success start_entrega "
                                                entrega="{{ $entrega->id }}"
                                                mot="{{ $entrega->colaborador_id }}"><i
                                                    class="fa-solid fa-play"></i></a>
                                        @elseif($entrega->status_id != $entrega->getStatusId('Finalizada'))
                                            <a href="{{ route('entrega.stop', ['entrega' => $entrega->id]) }}"
                                                id="Start_Ent_{{ $entrega->id }}"
                                                class="text-red-600 btn btn-outline-danger stop_entrega  "
                                                entrega="{{ $entrega->id }}"
                                                mot="{{ $entrega->colaborador_id }}"><i
                                                    class="fa-solid fa-stop"></i></a>
                                        @endif
                                        <a href="{{ route('entrega.show', ['entrega' => $entrega->id]) }}"
                                            id="Start_Ent_{{ $entrega->id }}"
                                            class="text-blue-600 btn btn-outline-primary  "
                                            entrega="{{ $entrega->id }}" mot="{{ $entrega->colaborador_id }}"><i
                                                class="fa-solid fa-eye"></i></a>
                                    </div>
                                </li>
                                <ul class="col-12">
                                    <li class=" col-md-3 col-12 d-block">
                                        <header>Cargas</header>
                                        <div class="d-flex justify-center flex-wrap">
                                        @foreach ($entrega->cargas as $carga)
                                            <ul class="cargas_index_entrega col-12 mr-2">
                                                <div class="d-flex justify-around col-12">
                                                    <li class="col-6"> <span class="title_index_entrega_mobile">Remessa</span><a href="{{ route('carga.show',['carga'=>$carga->id]) }}">{{ $carga->remessa }}</a></li>
                                                    <li class="col-6"> <span class="title_index_entrega_mobile">OS</span><a href="{{ route('carga.show',['carga'=>$carga->id]) }}">{{ $carga->os }}</a></li>
                                                </div>

                                                <li> <span class="title_index_entrega_mobile">Motorista</span><a href="{{ route('carga.show',['carga'=>$carga->id]) }}">{{ $carga->motorista->name }}</a></li>
                                                <li class="text-right"> <span class="title_index_entrega_mobile text-left">Destino</span>{{ $carga->destino }}</li>
                                                <li> <span class="title_index_entrega_mobile">Notas</span>{{ $carga->notas()->count() }}</li>
                                                <li> <span class="title_index_entrega_mobile">Entregas</span>{{ count($carga->paradas()) }}</li>
                                                <li title="{{ $carga->getStatus()->descricao }}"> <span class="title_index_entrega_mobile">Status</span>{{ $carga->getStatus()->name }}</li>
                                            </ul>

                                        @endforeach
                                        </div>
                                    </li>
                                </ul>
                            </ul>
                            @endforeach
                        </li>
                    </ul>

                    <div>{{ $entregas->links() }}</div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>


{{--
<table class=" text-center">
                        <thead class="">
                            <tr class="border-secondary border">
                                <th class="py-2">Motorista</th>
                                <th>Veículo</th>
                                <th>Ajudantes</th>
                                <th>Status</th>
                                <th>Ação</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $indice = 0;
                            @endphp
                            @foreach ($entregas as $entrega)
                                <tr class="{{ (($indice%2)==0)?'bg-claro':'bg-mais-claro' }} border-secondary border bg-blue-200">
                                    <td class="p-2">{{ $entrega->colaborador->name }}</td>
                                    <td>{{ $entrega->veiculo->placa }}</td>
                                    <td>
                                        <ul>
                                        @forelse ($entrega->ajudantes as $ajudante)
                                            <li>{{ $ajudante->name }}</li>
                                        @empty
                                            Não há ajudante
                                        @endforelse
                                    </ul>
                                    </td>
                                    <td>{{ $entrega->getStatus->descricao }}</td>
                                    <td>
                                        <div>
                                            @if ($entrega->status_id == $entrega->getStatusId('Pendente'))
                                                <a href="{{ route('entrega.start', ['entrega' => $entrega->id]) }}"
                                                    id="Start_Ent_{{ $entrega->id }}"
                                                    class="text-green-600 btn btn-outline-success start_entrega m-2"
                                                    entrega="{{ $entrega->id }}"
                                                    mot="{{ $entrega->colaborador_id }}"><i
                                                        class="fa-solid fa-play"></i></a>
                                            @elseif($entrega->status_id != $entrega->getStatusId('Finalizada'))
                                                <a href="{{ route('entrega.stop', ['entrega' => $entrega->id]) }}"
                                                    id="Start_Ent_{{ $entrega->id }}"
                                                    class="text-red-600 btn btn-outline-danger stop_entrega  m-2"
                                                    entrega="{{ $entrega->id }}"
                                                    mot="{{ $entrega->colaborador_id }}"><i
                                                        class="fa-solid fa-stop"></i></a>
                                            @endif
                                            <a href="{{ route('entrega.show', ['entrega' => $entrega->id]) }}"
                                                id="Start_Ent_{{ $entrega->id }}"
                                                class="text-blue-600 btn btn-outline-primary  m-2"
                                                entrega="{{ $entrega->id }}" mot="{{ $entrega->colaborador_id }}"><i
                                                    class="fa-solid fa-eye"></i></a>
                                        </div>
                                    </td>
                                </tr>
                                @php
                                    $indice++;
                                @endphp
                                <tr class="">
                                    <td colspan="5">
                                        <table class="col-12 border-secondary border mb-5">
                                            <thead>
                                                <tr class="border-secondary border">
                                                    <th class="p-2">Remessa</th>
                                                    <th>OS</th>
                                                    <th>Motorista</th>
                                                    <th>Destino</th>
                                                    <th>Notas</th>
                                                    <th>Entregas</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $i=0;
                                                @endphp
                                                @foreach ($entrega->cargas as $carga)
                                                    <tr class="{{ (($i%2)==0)?'bg-claro':'bg-mais-claro' }} border-secondary border">
                                                        <td class="p-2">{{ $carga->remessa }}</td>
                                                        <td><a href="{{ route('carga.show',['carga'=>$carga->id]) }}">{{ $carga->os }}</a></td>
                                                        <td><a href="{{ route('carga.show',['carga'=>$carga->id]) }}">{{ $carga->motorista->name }}</a></td>
                                                        <td>{{ $carga->destino }}</td>
                                                        <td>{{ $carga->notas()->count() }}</td>
                                                        <td>{{ count($carga->paradas()) }}</td>
                                                        <td title="{{ $carga->getStatus()->descricao }}">{{ $carga->getStatus()->name }}</td>
                                                    </tr>
                                                    @php
                                                        $i++;
                                                    @endphp
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
--}}
