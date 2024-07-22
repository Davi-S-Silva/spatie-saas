<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Entrega') }} {{ $entrega->id }}
        </h2>
    </x-slot>
    <div class="py-1">
        <div class="max-w-7xl mx-auto px-1">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="card col-12 p-2">
                    <form action="{{ route('receberVariasNotas',['entrega'=>$entrega->id]) }}" method="post" name="FormEncerraEntrega">
                    <header>
                        <ul>
                            <li>Motorista: <b>{{ $entrega->colaborador->name }}</b></li>
                            <li>Ajudantes: <b>
                                @forelse ($entrega->ajudantes as $ajudante)
                                {{  $ajudante->name }}
                                @empty
                                    Não há ajudantes
                                @endforelse
                            </b></li>
                            <li>Veiculo: <b>{{ $entrega->veiculo->placa }}</b></li>
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
                                <section class="d-flex flex-wrap justify-around">
                                    @forelse ($carga->notas()->with('destinatario','carga')->get() as $nota)
                                        <input type="checkbox" name="Notas[]" id="" value="{{$nota->id}}">
                                        <x-nota :nota=$nota />
                                    @empty
                                        não tem notas
                                    @endforelse
                                </section>
                                <footer>
                                    fim carga
                                    <hr />
                                </footer>
                            </article>
                        @empty
                            Não há cargas
                        @endforelse
                    </section>
                    <footer>
                        fim entrega
                    </footer>
                    @csrf
                    <input type="submit" value="Salvar" class="btn btn-primary">
                </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
