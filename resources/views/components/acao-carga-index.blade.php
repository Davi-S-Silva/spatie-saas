<div class="d-flex ml-2 justify-start">
    <a href="{{ route('carga.show', ['carga' => $carga->id]) }}" class="btn btn-primary"><i
        class="fa-solid fa-eye"></i></a>
    @if (
        $status->id == $carga->getStatusId('Carregado') ||
            $status->id == $carga->getStatusId('Notas') ||
            $status->id == $carga->getStatusId('Aguardando'))

        <a href="" class="btn btn-primary btn-seguir-viagem ml-2 d-none" data-toggle="modal" Carga="{{ $carga->id }}"><i
                class="fa-solid fa-play"></i></a>

        <div class="modal fade" id="Modal_{{ $carga->id }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Deseja Seguir viagem para qual destino?</h5>
                        {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                      </button> --}}
                    </div>
                    <div class="modal-body">
                        <a href="{{ route('SeguirViagem', ['carga' => $carga->id]) }}" destino="Cliente"
                            class="btn btn-primary destino-viagem">Cliente</a>
                        @foreach (Auth::user()->empresa->first()->localapoios as $item)
                            {{-- Auth::user()->empresa->first()->localapoios --}}
                            <a href="{{ route('SeguirViagem', ['carga' => $carga->id]) }}" destino="{{ $item->name }}"
                                class="btn btn-primary destino-viagem">{{ $item->name }}</a>
                        @endforeach
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal"
                            class="close-modal-viagem">Cancelar</button>
                        {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
