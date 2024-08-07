<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Cargas') }}
        </h2>
    </x-slot>
    <div class="py-1">
        <div class="mx-auto px-1">
            <section class="d-flex justify-center">
                <form action="" class="form_add_notas" method="post">
                    <header><a href="">X</a></header>
                    <div>
                        <legend>Form Add Notas</legend>
                        <textarea class="textarea_notas" name="Notas" id="" cols="60" rows="10"></textarea>
                    </div>
                    @csrf
                    <input type="submit" value="Inserir" class="btn btn-primary">
                </form>
            </section>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="card col-12 p-2">
                    <table class=" text-center align-items-center">
                        <thead>
                            <tr class="border-secondary border">
                                <th class="p-2">-</th>
                                <th><input type="checkbox" name="" id=""></th>
                                <th>Remessa</th>
                                <th>OS</th>
                                <th>Motorista</th>
                                <th>Origem</th>
                                <th>Destino</th>
                                <th>Veículo</th>
                                <th>Notas</th>
                                <th>Entregas</th>
                                <th>Frete</th>
                                <th>Diária</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                    @php
                        $indice = 0;
                    @endphp
                    @foreach ($cargas as $carga)
                        {{-- <ul>
                            <li><b><a href="{{ route('carga.show',['carga'=>$carga->id]) }}">{{ $carga->id }} - {{ $carga->area }} - {{ $carga->motorista->name }} - {{ $carga->peso }} - {{ isset($carga->veiculo->placa)?$carga->veiculo->placa:'' }}</b></a><a href="{{ route('carga.edit',['carga'=>$carga->id]) }}"><i class="fa-regular fa-pen-to-square"></i></a>
                                <ul>
                                    <header>Notas: {{ $carga->notas()->count() }} - entregas:  {{ count($carga->paradas()) }}</header>


                                    @forelse ($carga->notas as $nota)
                                       <li>{{ $nota->nota }}
                                            <ul>
                                                <li>{{ $nota->destinatario->nome_razao_social }}
                                                    <ul>{{ $nota->destinatario->endereco->endereco }}</ul>
                                                </li>
                                            </ul>
                                            <hr>
                                       </li>
                                    @empty
                                        <li>nenhuma nota cadastrada</li>
                                    @endforelse
                                </ul>
                                <a class="btn btn-primary add-notas-carga" href="{{ route('carga.setNotas',['carga'=>$carga->id]) }}" id="Carga {{$carga->id}}">Add Notas</a>
                            </li>
                        </ul> --}}
                        <tr class="{{ (($indice%2)==0)?'bg-claro':'bg-mais-claro' }} tr-cargas border-secondary border">
                            <td class="show-detalhe-cargas p-2 m-1" Carga={{ $carga->id }}><i class="fa-regular fa-square-plus"></i></td>
                            <td><input type="checkbox" name="" id=""></td>
                            <td><a href="{{ route('carga.show',['carga'=>$carga->id]) }}">{{ $carga->remessa }}</a></td>
                            <td><a href="{{ route('carga.show',['carga'=>$carga->id]) }}">{{ $carga->os }}</a></td>
                            <td>{{ $carga->motorista->name }}</td>
                            <td>{{ $carga->filial->nome_fantasia }}</td>
                            <td>{{ $carga->destino }}</td>
                            <td class="cursor-pointer" title="Clique para trocar de veículo">{{ $carga->veiculo->placa }}</td>
                            <td>{{ $carga->notas()->count() }}</td>
                            <td>{{ count($carga->paradas()) }}</td>
                            <td>R$ {{ number_format($carga->frete,2,',','.') }}</td>
                            <td class="cursor-pointer" title="Clique para adicionar diária">0</td>
                            @php
                                $status = $carga->getStatus();
                            @endphp
                            <td title="{{ $status ->descricao }}">{{ $status ->name }}</td>
                        </tr>
                        @php
                            $indice++;
                        @endphp
                        <tr id="Carga_{{ $carga->id }}" class="area-show-detalhe">
                            <td colspan="13" class="bg-slate-200">
                                <ul class="nav nav-tabs  bg-white" id="myTab_{{ $carga->id }}" role="tablist">
                                    <li class="nav-item" role="presentation">
                                      <button class="nav-link active" id="home-tab_{{ $carga->id }}" data-bs-toggle="tab" data-bs-target="#home_{{ $carga->id }}"
                                      type="button" role="tab" aria-controls="home_{{ $carga->id }}" aria-selected="true">Notas</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                      <button class="nav-link" id="profile-tab_{{ $carga->id }}" data-bs-toggle="tab" data-bs-target="#profile_{{ $carga->id }}"
                                      type="button" role="tab" aria-controls="profile_{{ $carga->id }}" aria-selected="false">Documentação</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                      <button class="nav-link" id="contact-tab_{{ $carga->id }}" data-bs-toggle="tab" data-bs-target="#contact_{{ $carga->id }}"
                                      type="button" role="tab" aria-controls="contact_{{ $carga->id }}" aria-selected="false">Histórico</button>
                                    </li>
                                  </ul>
                                  <div class="tab-content" id="myTabContent_{{ $carga->id }}">
                                    <div class="tab-pane fade show active" id="home_{{ $carga->id }}" role="tabpanel" aria-labelledby="home-tab_{{ $carga->id }}">
                                        {{-- {{ $carga->countNotasPendentes() }} --}}
                                        <a class="btn btn-primary add-notas-carga" href="{{ route('carga.setNotas',['carga'=>$carga->id]) }}" id="Carga {{$carga->id}}">Add Notas</a>
                                        <table class="text-center col-12">
                                            <thead>
                                                <tr class="border-secondary border">
                                                    <th class="py-2">Número</th>
                                                    <th>Chave de Acesso</th>
                                                    <th>Emitente</th>
                                                    <th>Destinatario</th>
                                                    <th>Endereco</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $i=0;
                                                @endphp
                                            @forelse ($carga->notas as $nota)
                                                <tr class="{{ (($i%2)==0)?'bg-white':'' }} border-secondary border">
                                                    <td class="py-2">{{ $nota->nota }}</td>
                                                    <td>{{ $nota->chave_acesso }}</td>
                                                    <td>{{ $nota->filial->nome_fantasia }}</td>
                                                    <td>{{ $nota->destinatario->nome_razao_social }}</td>
                                                    <td>{{ strtolower($nota->destinatario->endereco->endereco) }}, {{ $nota->destinatario->endereco->numero }},
                                                        {{ strtolower($nota->destinatario->endereco->bairro) }}, {{ $nota->destinatario->endereco->cep }} -
                                                        {{ $nota->destinatario->endereco->cidade->nome }}</td>
                                                    <td>{{ $nota->status->descricao }}</td>
                                                </tr>
                                                @php
                                                    $i++;
                                                @endphp
                                            @empty
                                                Não há notas
                                            @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="tab-pane fade" id="profile_{{ $carga->id }}" role="tabpanel" aria-labelledby="profile-tab_{{ $carga->id }}">Conhecimento de transporte, Manifesto, assinante, descarrego, canhoto, entrada de ceasa....</div>
                                    <div class="tab-pane fade" id="contact_{{ $carga->id }}" role="tabpanel" aria-labelledby="contact-tab_{{ $carga->id }}">Observacoes da carga e etc</div>
                                  </div>

                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                    </table>
                </div>
            </div>

        </div>

    </div>
</x-app-layout>
