<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Cargas') }}
        </h2>
    </x-slot>
    <div class="py-1">
        <div class="mx-auto px-1">
            {{-- <section class="d-flex justify-center">
                <form action="" class="form_add_notas" method="post">
                    <header><a href="">X</a></header>
                    <div>
                        <legend>Form Add Notas</legend>
                        <textarea class="textarea_notas" name="Notas" id="" cols="60" rows="10"></textarea>
                    </div>
                    @csrf
                    <input type="submit" value="Inserir" class="btn btn-primary">
                </form>
            </section> --}}
            <x-set-notas-carga />
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="card col-12 p-2">
                    <table class=" text-center align-items-center">
                        <thead>
                            <tr class="border-secondary border">
                                <th class="p-2">-</th>
                                <th><input type="checkbox" name="" id=""></th>
                                <th>Data</th>
                                <th>Remessa</th>
                                <th>OS</th>
                                <th class="col-2">Motorista</th>
                                <th class="col-2">Origem</th>
                                <th class="col-2">Destino</th>
                                {{-- <th>Agenda</th> --}}
                                <th class="">Veículo</th>
                                <th class="col-2">Notas</th>
                                <th>Entregas</th>
                                <th class="col-1">Frete</th>
                                <th>Diária</th>
                                <th class="col-2">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $indice = 0;
                            @endphp
                            @foreach ($cargas as $carga)
                                <tr
                                    class="{{ $indice % 2 == 0 ? 'bg-claro' : 'bg-mais-claro' }} tr-items border-secondary border">
                                    <td class="show-detalhe-items px-2 py-3 m-1" Item={{ $carga->id }}><i
                                            class="fa-regular fa-square-plus"></i></td>
                                    <td><input type="checkbox" name="" id=""></td>
                                    <td>{{ date('d/m/Y', strtotime($carga->data)) }}</td>
                                    <td><a
                                            href="{{ route('carga.show', ['carga' => $carga->id]) }}" class="click_botao_direito position-relative" copy="{{ $carga->remessa }}"
                                            title="Clique com o botao direito do mouse para copiar texto">{{ $carga->remessa }}</a>
                                    </td>
                                    <td><a
                                            href="{{ route('carga.show', ['carga' => $carga->id]) }}" class="click_botao_direito position-relative" copy="{{ $carga->os }}"
                                            title="Clique com o botao direito do mouse para copiar texto">{{ $carga->os }}</a>
                                    </td>
                                    <td><div class="div-overflow-carga" title="{{ $carga->motorista->name }}">{{ $carga->motorista->name }}</div></td>
                                    <td><div class="div-overflow-carga" title="{{ $carga->filial->nome_fantasia }}">{{ $carga->filial->nome_fantasia }}</div></td>
                                    <td><div class="div-overflow-carga" title="{{ $carga->destino }}">{{ $carga->destino }}</div></td>
                                    {{-- <td>{{ date('d/m/Y', strtotime($carga->agenda)) }}</td> --}}
                                    <td class="cursor-pointer" title="">
                                        {{ isset($carga->veiculo->placa) ? $carga->veiculo->placa : '' }}
                                    </td>
                                    <td class="col-12 d-flex align-items-center">
                                        <div class="col-9 py-3 d-flex align-items-center">
                                            <div class="progress col-9 bg-info">
                                                <div class="progress-bar progress-bar-striped bg-primary" style="width: {{ $carga->porcentagemNotas() }}"
                                                    role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="{{ $carga->notas()->count() }}">
                                                    {{ $carga->porcentagemNotas() }}
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                {{ ($carga->notasPorStatus('devolvida')->count()+$carga->notasPorStatus('entregue')->count()) }}/{{ $carga->notas()->count() }}
                                            </div>
                                        </div>
                                        <div class="d-flex justify-around col-3 py-2">
                                            <div class="text-primary">{{ $carga->notasPorStatus('pendente')->count() }}</div>
                                            <div class="text-danger">{{ $carga->notasPorStatus('devolvida')->count() }}</div>
                                            <div class="text-success">{{ $carga->notasPorStatus('entregue')->count() }}</div>
                                    </div>
                                    </td>
                                    <td>{{ count($carga->paradas()) }}</td>
                                    <td>R$ {{ number_format($carga->frete, 2, ',', '.') }}</td>
                                    <td class="cursor-pointer" title="Clique para adicionar diária"><a href="{{ route('formDiaria',['carga'=>$carga->id]) }}" class="add-diaria">{{ $carga->diaria }}</a></td>
                                    @php
                                        $status = $carga->getStatus();
                                    @endphp
                                    <td title="{{ $status->descricao }}" class="@php
                                        if($status->name =='Rota'){
                                            echo 'text-success';
                                        }else if($status->name =='Finalizada'){
                                            echo 'text-dark';
                                        }else if($status->name =='Aguardando'){
                                            echo 'text-warning';
                                        }else{
                                            echo 'text-primary';
                                        }
                                    @endphp font-bold">
                                        {{ $status->descricao }}
                                    </td>
                                </tr>
                                @php
                                    $indice++;
                                @endphp
                                <tr id="Item_{{ $carga->id }}" class="area-show-detalhe">
                                    <td colspan="15" class="bg-slate-200">
                                        <ul class="nav nav-tabs  bg-white" id="myTab_{{ $carga->id }}"
                                            role="tablist">
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link active" id="home-tab_{{ $carga->id }}"
                                                    data-bs-toggle="tab" data-bs-target="#home_{{ $carga->id }}"
                                                    type="button" role="tab"
                                                    aria-controls="home_{{ $carga->id }}"
                                                    aria-selected="true">Notas</button>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link" id="profile-tab_{{ $carga->id }}"
                                                    data-bs-toggle="tab" data-bs-target="#profile_{{ $carga->id }}"
                                                    type="button" role="tab"
                                                    aria-controls="profile_{{ $carga->id }}"
                                                    aria-selected="false">Documentação</button>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link" id="contact-tab_{{ $carga->id }}"
                                                    data-bs-toggle="tab" data-bs-target="#contact_{{ $carga->id }}"
                                                    type="button" role="tab"
                                                    aria-controls="contact_{{ $carga->id }}"
                                                    aria-selected="false">Histórico</button>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link" id="entrega-tab_{{ $carga->id }}"
                                                    data-bs-toggle="tab" data-bs-target="#entrega_{{ $carga->id }}"
                                                    type="button" role="tab"
                                                    aria-controls="entrega_{{ $carga->id }}"
                                                    aria-selected="false">Entrega</button>
                                            </li>
                                            {{-- <li class="nav-item" role="presentation">
                                                <button class="nav-link" id="produtos-tab_{{ $carga->id }}"
                                                    data-bs-toggle="tab" data-bs-target="#produtos_{{ $carga->id }}"
                                                    type="button" role="tab"
                                                    aria-controls="produtos_{{ $carga->id }}"
                                                    aria-selected="false">Produtos</button>
                                            </li> --}}
                                        </ul>
                                        <div class="tab-content" id="myTabContent_{{ $carga->id }}">
                                            <div class="tab-pane fade show active" id="home_{{ $carga->id }}"
                                                role="tabpanel" aria-labelledby="home-tab_{{ $carga->id }}">
                                                {{-- {{ $carga->countNotasPendentes() }} --}}
                                                <a class="btn btn-primary add-notas-carga"
                                                    href="{{ route('carga.setNotas', ['carga' => $carga->id]) }}"
                                                    id="Carga {{ $carga->id }}">Add Notas</a>
                                                <table class="text-center col-12">
                                                    <thead>
                                                        <tr class="border-secondary border">
                                                            <th class="py-2 col-1">Número</th>
                                                            <th class="col-3">Chave de Acesso</th>
                                                            <th class="col-2">Emitente</th>
                                                            <th class="col-2">Destinatario</th>
                                                            <th class="col-2">Endereco</th>
                                                            <th class="col-2">Status</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @php
                                                            $i = 0;
                                                        @endphp
                                                        @forelse ($carga->notas()->orderBy('destinatario_id','asc')->with('destinatario','status','filial','destinatario.endereco',
                                                        'destinatario.endereco.cidade','destinatario.endereco.estado')->get() as $nota)
                                                            <tr
                                                                class="{{ $i % 2 == 0 ? 'bg-white' : '' }} border-secondary border">
                                                                <td class="py-2">{{ $nota->nota }}</td>
                                                                <td class="click_botao_direito position-relative" copy="{{ $nota->chave_acesso }}"
                                                                    title="Clique com o botao direito do mouse para copiar texto">{{ $nota->chave_acesso }}</td>
                                                                <td>{{ $nota->filial->nome_fantasia }}</td>
                                                                <td>
                                                                    {{ $nota->destinatario->cpf_cnpj }} -
                                                                    {{ $nota->destinatario->nome_razao_social }}
                                                                </td>
                                                                <td class="col-3">
                                                                    {{ strtolower($nota->destinatario->endereco->endereco) }},
                                                                    {{ $nota->destinatario->endereco->numero }},
                                                                    {{ strtolower($nota->destinatario->endereco->bairro) }},
                                                                    {{ $nota->destinatario->endereco->cep }} -
                                                                    {{ $nota->destinatario->endereco->cidade->nome }}
                                                                </td>
                                                                <td class="
                                                                @php
                                                                    if($nota->status->name =='Entregue'){
                                                                        echo 'text-success';
                                                                    }else if($nota->status->name =='Devolvida'){
                                                                        echo 'text-danger';
                                                                    }else{
                                                                        echo 'text-primary';
                                                                    }
                                                                @endphp
                                                                ">{{ $nota->status->descricao }}</td>
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
                                            <div class="tab-pane fade" id="profile_{{ $carga->id }}" role="tabpanel"
                                                aria-labelledby="profile-tab_{{ $carga->id }}">
                                                Conhecimento de transporte, Manifesto, assinante, descarrego, canhoto,
                                                entrada de ceasa....
                                                <ul>
                                                    <li>
                                                        <a href="{{ route('gerarListaDevolucao', ['carga' => $carga->id]) }}"
                                                            target="_blank">Gerar Relatório de devolução</a>
                                                    </li>
                                                    <li><a href="#">Add Assinante</a></li>
                                                </ul>
                                            </div>
                                            <div class="tab-pane fade" id="contact_{{ $carga->id }}" role="tabpanel"
                                                aria-labelledby="contact-tab_{{ $carga->id }}">
                                                Observacoes da carga e etc</div>
                                            <div class="tab-pane fade" id="entrega_{{ $carga->id }}"
                                                role="tabpanel" aria-labelledby="entrega-tab_{{ $carga->id }}">
                                                @foreach ($carga->entregas()->with('veiculo', 'colaborador','getStatus')->get() as $item)
                                                <a href="{{ route('entrega.show',['entrega'=>$item->id]) }}">
                                                    <ul>
                                                        <li>{{ $item->colaborador->name }}</li>
                                                        <li>{{ $item->veiculo->placa }}</li>
                                                        <li>{{ $item->getStatus->descricao }}</li>
                                                        <li>{{ date('d/m/Y H:i:s', strtotime($item->updated_at)) }}
                                                        </li>
                                                    </ul>
                                                </a>
                                                @endforeach
                                            </div>
                                            {{-- <div class="tab-pane fade " id="produtos_{{ $carga->id }}"
                                                role="tabpanel" aria-labelledby="produtos-tab_{{ $carga->id }}">
                                                @php
                                                $dados = $carga->produtos();
                                                @endphp
                                                @if (!is_null($dados))
                                                    <table class="table-striped table table-hover">
                                                        <thead>
                                                            <tr>
                                                                <td>Produto</td>
                                                                <td>Quantidade</td>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($dados as $produto)
                                                                <tr>
                                                                    <td>{{ $produto['nome'] }}</td>
                                                                    <td>{{ $produto['total_produto'] }}</td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                @else
                                                    não tem produtos cadastrados
                                                @endif
                                            </div> --}}
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div>
                        {{ $cargas->links() }}
                    </div>
                </div>
            </div>

        </div>

    </div>
</x-app-layout>
