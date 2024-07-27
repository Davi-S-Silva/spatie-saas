<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Entregas') }}
        </h2>
    </x-slot>
    <div class="py-1">
        <div class="max-w-7xl mx-auto px-1">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="card col-12 p-2">
                    <form action="" name="StartEntrega" class="form_toggle_entrega" method="post">
                        <legend>Iniciar entrega <span></span></legend>
                        {{-- <div class="col-12">
                            <x-select-colaborador :funcao=1/>
                        </div> --}}
                        <div>
                            <label for="">Km Inicial</label>
                            <input type="text" required name="KmInicial">
                        </div>
                        <input type="hidden" name="Entrega">
                        @csrf
                        <input type="submit" class="btn btn-primary" value="Salvar">
                    </form>
                    <form action="" name="StopEntrega" class="form_toggle_entrega" method="post">
                        <legend>Finalizar entrega <span></span></legend>
                        {{-- <div class="col-12">
                            <x-select-colaborador :funcao=1/>
                        </div> --}}
                        <div>
                            <label for="">Km Final</label>
                            <input type="text" required name="KmFinal">
                        </div>
                        <div>
                            <label for="">Local de destido</label>
                            <select name="LocalDestino" id="">
                                <option value="">Selecione o local de destino do veiculo</option>
                                @foreach ($localMovimentacao as $local)
                                    <option value="{{ $local->id }}">{{ $local->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <input type="hidden" name="Entrega">
                        @csrf
                        <input type="submit" class="btn btn-primary" value="Salvar">
                    </form>
                    <table class=" text-center">
                        <thead>
                            <tr class="border-secondary border">
                                <th class="p-2">Motorista</th>
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
                                <tr class="{{ (($indice%2)==0)?'bg-claro':'bg-mais-claro' }} border-secondary border">
                                    <td class="p-2">{{ $entrega->colaborador->name }}</td>
                                    <td>{{ $entrega->veiculo->placa }}</td>
                                    <td>
                                        @forelse ($entrega->ajudantes as $ajudante)
                                            {{ $ajudante->name }}
                                        @empty
                                            Não há ajudante
                                        @endforelse
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
                                        <table class="col-12 border-secondary border">
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
                                                        <td>{{ $carga->os }}</td>
                                                        <td>{{ $carga->motorista->name }}</td>
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

                    <div>{{ $entregas->links() }}</div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
