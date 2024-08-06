<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Entrega') }} {{ $entrega->id }}
        </h2>
    </x-slot>
    <div class="py-1">
        <div class="max-w-7xl mx-auto px-1">
            <div id="AcoesEntrega" class="d-flex flex-column p-0 m-0">
                <button class="btn btn-danger submit_entrega" name="Devolver">Devolver</button>
                <button class="btn btn-success submit_entrega" name="Receber">Receber</button>
                <button class="btn btn-info submit_entrega" name="Calcular">Calcular</button>
                {{-- <input class="btn btn-danger" value="Devolver"/>
                <input class="btn btn-success" value="Receber"/>
                <input class="btn btn-info" value="Calcular"/> --}}
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <div class="card col-12 p-2">
                    <form action="{{ route('receberVariasNotas', ['entrega' => $entrega->id]) }}" method="post"
                        name="FormEncerraEntrega">
                        <header>
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
                                            <div class="col-lg-4 col-11 d-flex justify-around align-items-center">
                                                <x-nota :nota=$nota />
                                            </div>
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
    <section id="AreaResultados" class="col-10">
        <div id="Resultados" class="col-sm-2 col-10">
            <header class="d-flex justify-between align-items-center p-3"><div>Resultados</div><div class="m-2 cursor-pointer close_modal"><i class="fa-regular fa-rectangle-xmark"></i></div></header>
            <div id="Content" class="py-3 px-5">
                <ul>
                    <li class="peso"></li>
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
