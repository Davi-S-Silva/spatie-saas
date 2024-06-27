<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Movimentações') }}
        </h2>
    </x-slot>
    <div class="py-1">
        <div class="max-w-7xl mx-auto px-1">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="card col-12 p-2">
                    <form action="" name="StartMov" class="form_toggle_mov" method="post">
                        <legend>Movimentacao <span></span></legend>
                        <div class="col-12">
                            <x-select-colaborador :funcao=1/>
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
                            <input type="text" name="KmFinal"/>
                        </div>
                        <input type="hidden" name="Mov">
                        @csrf
                        <input type="submit" class="btn btn-primary" value="Salvar">
                    </form>
                    <ul>
                        @forelse ($movimentacoes as $movimentacao)
                        <li class="my-2"> {{ $movimentacao->colaborador->name }}
                             <b>Partida</b> {{ $movimentacao->partida->title }}
                             <b>Destino</b> {{ $movimentacao->destino->title }}
                             <b>Placa</b> {{ $movimentacao->veiculo->placa }}
                             <b>Km Inicio</b>{{ $movimentacao->km_inicio }}
                             {{-- <form action="{{ route('movimentacao.toggleMov',['movimentacao'=>$movimentacao->id]) }}" method="post" name="FormToggleMov"> --}}
                                {{-- @csrf --}}
                                {{-- <input type="image" name="StartMove" src="{{ asset('img/play.png') }}" value="1"></form> --}}
                                @if ($movimentacao->status_id==1)
                                    <a  href="{{ route('movimentacao.start',['movimentacao'=>$movimentacao->id]) }}"
                                        id="Start_Mov_{{ $movimentacao->id }}"
                                        class="text-green-600 btn btn-outline-success start_mov"
                                        mov="{{ $movimentacao->id }}"
                                        mot="{{ $movimentacao->colaborador_id }}"><i class="fa-solid fa-play"></i></a>
                                @endif
                                @if ($movimentacao->status_id==2)
                                    <a  href="{{ route('movimentacao.stop',['movimentacao'=>$movimentacao->id]) }}" class="text-red-600 btn btn-outline-danger stop_mov"
                                        id="Stop_Mov_{{ $movimentacao->id }}"
                                        mov="{{ $movimentacao->id }}"><i class="fa-solid fa-stop"></i></a>
                                @else

                                    <a  href="{{ route('movimentacao.stop',['movimentacao'=>$movimentacao->id]) }}" class="text-red-600 btn btn-outline-danger stop_mov d-none"
                                        id="Stop_Mov_{{ $movimentacao->id }}"
                                        mov="{{ $movimentacao->id }}"><i class="fa-solid fa-stop"></i></a>
                                @endif
                            </li>
                        @empty
                        não há movimentações
                        @endforelse
                    </ul>
                    <div>
                        {{ $movimentacoes->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
