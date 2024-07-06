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
                    @foreach ($entregas as $entrega)
                        <ul>
                            <li class="mb-3">
                                {{-- <b><a href="{{ route('clientes.show',['cliente'=>$cliente->id]) }}">{{ $cliente->name }}</b></a> --}}
                                <ul>
                                    <li class="p-2 bg-slate-100">
                                        <header class="d-flex justify-content-between">
                                            <div><b>Motorista: </b>{{ $entrega->colaborador->name }}</div>
                                            <div><b>Veiculo: </b>{{ $entrega->veiculo->placa }}</div>
                                            <div><b>Ajudantes: </b>
                                                @php
                                                    $i=0;
                                                @endphp
                                                @forelse ( $entrega->ajudantes as $ajudante )
                                                {{ $ajudante->name }}
                                                @php
                                                    if($i<count($entrega->ajudantes)-1){
                                                        echo ',';
                                                    }
                                                    $i++;
                                                @endphp
                                                @empty
                                                    Não há ajudantes
                                                @endforelse


                                            </div>
                                            <div>
                                                <b>Status: </b>{{ $entrega->getStatus->descricao }}
                                            </div>
                                        </header>
                                            <ul class="px-3">
                                            @foreach ($entrega->cargas as $item)
                                                <li><b>Remessa: </b>{{ $item->remessa }} <b>OS: </b>{{ $item->os }} <b>Motorista OS: </b>{{ $item->motorista->name }} <b>Área: </b>{{ $item->area }}</li>
                                            @endforeach
                                            </ul>
                                            <div>
                                                @if ($entrega->status_id == $entrega->status('Pendente'))
                                                    <a  href="{{ route('entrega.start',['entrega'=>$entrega->id]) }}"
                                                    id="Start_Ent_{{ $entrega->id }}"
                                                    class="text-green-600 btn btn-outline-success start_entrega"
                                                    entrega="{{ $entrega->id }}"
                                                    {{-- mot="{{ $entrega->colaborador_id }}" --}}
                                                    ><i class="fa-solid fa-play"></i></a>
                                                @else
                                                    <a  href="{{ route('entrega.stop',['entrega'=>$entrega->id]) }}"
                                                    id="Start_Ent_{{ $entrega->id }}"
                                                    class="text-red-600 btn btn-outline-danger stop_entrega"
                                                    entrega="{{ $entrega->id }}"
                                                    {{-- mot="{{ $entrega->colaborador_id }}" --}}
                                                    ><i class="fa-solid fa-stop"></i></a>
                                                @endif
                                                <a  href="{{ route('entrega.show',['entrega'=>$entrega->id]) }}"
                                                    {{-- id="Start_Ent_{{ $entrega->id }}" --}}
                                                    class="text-blue-600 btn btn-outline-primary"
                                                    entrega="{{ $entrega->id }}"
                                                    {{-- mot="{{ $entrega->colaborador_id }}" --}}
                                                    ><i class="fa-solid fa-eye"></i></a>
                                            </div>
                                    </li>
                                </ul>
                                {{-- <a class="btn btn-primary" href="{{ route('filial.create',['cliente'=>$cliente->id]) }}">Nova Filial</a> --}}
                            </li>
                        </ul>
                    @endforeach

                    <div>{{ $entregas->links() }}</div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
