<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Movimentações') }}
        </h2>
    </x-slot>
    <div class="py-1">
        <div class="mx-auto px-1">


            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="card col-12 p-2">
                    <section>
                        <form action="{{ route('postQueryIndexMovimentacao') }}" method="post" class="d-flex align-items-end justify-center mb-5 flex-wrap">
                            <div class="col-2 mr-2">
                                <x-select-veiculo />
                            </div>
                            <div class="col-2 mr-2">
                                @php
                                    $name = 'Partida';
                                @endphp
                                {{-- <label for="" class="form-label">Partida</label> --}}
                                <x-select-local-movimentacao :localMovimentacao=$localMov :name=$name/>
                            </div>
                            <div class="col-2 mr-2">
                                @php
                                    $name = 'Destino';
                                @endphp
                                {{-- <label for="" class="form-label">Destino</label> --}}
                                <x-select-local-movimentacao :localMovimentacao=$localMov :name=$name/>
                            </div>
                            <div class="col-2 mr-2">
                                <x-select-colaborador :funcao=1 :required=false />
                            </div>

                            <div class="mr-2">
                                <label for="" class="form-label">Status</label>
                                <x-select-all-status :statusAll=$statusAll/>
                            </div>

                            <div>
                                @csrf
                                <input type="submit" value="Buscar" class="btn btn-primary">
                                <input type="submit" name="Reset" value="Limpar filtros" class="btn btn-danger">
                            </div>
                        </form>
                    </section>
                    <form action="" name="StartMov" class="form_toggle_mov" method="post">
                        <legend>Movimentacao <span></span></legend>
                        <div class="col-12">
                            <x-select-colaborador :funcao=1 :required=true />
                        </div>
                        <div>
                            <label for="">Km Inicial</label>
                            <input type="text" required name="KmInicial">
                        </div>
                        <input type="hidden" name="Mov">
                        @csrf
                        <input type="submit" class="btn btn-primary" value="Salvar">
                    </form>
                    <form action="" name="StopMov" class="form_toggle_mov" method="post">
                        <legend>Movimentacao <span></span></legend>
                        <div>
                            <label for="">Km Final</label>
                            <input type="text" name="KmFinal" />
                        </div>
                        <input type="hidden" name="Mov">
                        @csrf
                        <input type="submit" class="btn btn-primary" value="Salvar">
                    </form>

                    <table class=" text-center align-items-center text-sm">
                        <thead>
                            <tr class="border-secondary border">
                                @php
                                    $array = [
                                        ['name' => 'Data', 'item' => 'created_at', 'class' => ''],
                                        // ['name' => 'OS', 'item' => 'os','class'=>'col-1'],
                                        ['name' => 'Motorista', 'item' => 'colaborador_id', 'class' => 'col-2'],
                                        ['name' => 'Partida', 'item' => '', 'class' => 'col-1'],
                                        ['name' => 'Destino', 'item' => 'destino', 'class' => 'col-1'],
                                        ['name' => 'Veiculo', 'item' => 'veiculo_id', 'class' => 'col-1'],
                                        ['name' => 'Data Inicio', 'item' => 'created_at', 'class' => ''],
                                        ['name' => 'KM Inicio', 'item' => 'created_at', 'class' => ''],
                                        ['name' => 'Data Fim', 'item' => 'created_at', 'class' => ''],
                                        ['name' => 'KM Fim', 'item' => 'created_at', 'class' => ''],
                                        ['name' => 'Status', 'item' => 'status_id', 'class' => 'col-1'],
                                        ['name' => 'Ação', 'item' => '', 'class' => 'col-1'],
                                    ];
                                @endphp
                                <th class="p-2">-</th>
                                <th><input type="checkbox" name="" id=""></th>

                                @foreach ($array as $item)
                                    <th class="{{ $item['class'] }}">
                                        @if (session()->has('order-by-items-item') &&
                                                session('order-by-items-item') == $item['item'] &&
                                                session()->has('order-by-items-order') &&
                                                session('order-by-items-order') == 'asc')
                                            <a href="?item={{ $item['item'] }}&order=asc" class="order-by-items"><i
                                                    class="fa-solid fa-arrow-up-wide-short text-info"></i></a>
                                        @else
                                            <a href="?item={{ $item['item'] }}&order=asc" class="order-by-items"><i
                                                    class="fa-solid fa-arrow-up-wide-short"></i></a>
                                        @endif

                                        {{ $item['name'] }}
                                        @if (session()->has('order-by-items-item') &&
                                                session('order-by-items-item') == $item['item'] &&
                                                session()->has('order-by-items-order') &&
                                                session('order-by-items-order') == 'desc')
                                            <a href="?item={{ $item['item'] }}&order=desc" class="order-by-items"><i
                                                    class="fa-solid fa-arrow-down-wide-short text-info"></i></a>
                                        @else
                                            <a href="?item={{ $item['item'] }}&order=desc" class="order-by-items"><i
                                                    class="fa-solid fa-arrow-down-wide-short"></i></a>
                                        @endif
                                    </th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($movimentacoes as $movimentacao)
                                <tr class=" tr-items border-secondary border">
                                    <td class=""></td>
                                    <td></td>
                                    <td>{{ $movimentacao->created_at }}</td>
                                    <td class="d-flex justify-between px-5">
                                        {{ !is_null($movimentacao->colaborador) ? $movimentacao->colaborador->name : '-' }}
                                    </td>
                                    <td>{{ $movimentacao->partida->title }}</td>
                                    <td>{{ $movimentacao->destino->title }}</td>
                                    <td><a href="{{ route('veiculo.show',['veiculo'=>$movimentacao->veiculo->id]) }}">{{ $movimentacao->veiculo->placa }}</a></td>
                                    {{-- <td>{{ date('d/m/Y', strtotime($carga->agenda)) }}</td> --}}
                                    <td>{{ !is_null($movimentacao->data_hora_inicio) ? $movimentacao->data_hora_inicio : '-' }}</td>
                                    <td>{{ !is_null($movimentacao->kmInicio) ? $movimentacao->kmInicio->km : '-' }}</td>
                                    <td >{{ !is_null($movimentacao->data_hora_fim) ? $movimentacao->data_hora_fim: '-' }}</td>
                                    <td>{{ !is_null($movimentacao->kmFim) ? $movimentacao->kmFim->km : '-' }}</td>
                                    <td>{{ $movimentacao->getStatus->descricao }}</td>
                                    {{-- <td class="cursor-pointer" title="Clique para adicionar diária"><a href="{{ route('formDiaria',['carga'=>$carga->id]) }}" class="add-diaria add-diaria-{{ $carga->id }}">{{ $carga->diaria }}</a></td> --}}

                                    <td>
                                        @if ($movimentacao->status_id == $movimentacao->getStatusId('Pendente'))
                                            <a href="{{ route('movimentacao.start', ['movimentacao' => $movimentacao->id]) }}"
                                                id="Start_Mov_{{ $movimentacao->id }}"
                                                class="text-green-600 btn btn-outline-success start_mov"
                                                mov="{{ $movimentacao->id }}"
                                                mot="{{ $movimentacao->colaborador_id }}"><i
                                                    class="fa-solid fa-play"></i></a>
                                        @endif
                                        @if (
                                            $movimentacao->status_id == $movimentacao->getStatusId('Iniciada') ||
                                                $movimentacao->status_id == $movimentacao->getStatusId('Rota'))
                                            <a href="{{ route('movimentacao.stop', ['movimentacao' => $movimentacao->id]) }}"
                                                class="text-red-600 btn btn-outline-danger stop_mov"
                                                id="Stop_Mov_{{ $movimentacao->id }}" mov="{{ $movimentacao->id }}"><i
                                                    class="fa-solid fa-stop"></i></a>
                                        @else
                                            <a href="{{ route('movimentacao.stop', ['movimentacao' => $movimentacao->id]) }}"
                                                class="text-red-600 btn btn-outline-danger stop_mov d-none"
                                                id="Stop_Mov_{{ $movimentacao->id }}" mov="{{ $movimentacao->id }}"><i
                                                    class="fa-solid fa-stop"></i></a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div>
                        {{ $movimentacoes->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
