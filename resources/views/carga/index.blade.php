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
                    @if (Auth::user()->roles()->first()->name == 'tenant-admin-master' || Auth::user()->roles()->first()->name == 'tenant-admin' || Auth::user()->roles()->first()->name == 'admin' || Auth::user()->roles()->first()->name == 'super-admin')
                    <section>
                        <form action="{{ route('postQueryIndexCarga') }}" method="post" class="d-flex align-items-end justify-center mb-5 flex-wrap">
                            <div class="col-1 mr-2">
                                <label for="" class="form-label">Remessa/OS</label>
                                <input type="number" name="NumeroDoc" class="form-control rounded border-black" id="">
                            </div>
                            <div class="col-2 mr-2">
                                <x-select-veiculo />
                            </div>
                            <div class="col-2 mr-2">
                                <label for="" class="form-label">Origem</label>
                                <x-select-cliente />
                            </div>
                            <div class="col-2 mr-2">
                                <x-select-colaborador :funcao=1 :required=false />
                            </div>
                            <div class="d-flex mr-2">
                                <div class=" mr-2">
                                    <label for=""class="form-label">Data Inicio</label>
                                    <input type="date" class="form-control rounded border-black" name="Inicio" id="">
                                </div>
                                <div class=" mr-2">
                                    <label for=""class="form-label">Data Final</label>
                                    <input type="date" class="form-control rounded border-black" name="Fim" id="">
                                </div>
                            </div>
                            <div class="mr-2">
                                <label for="" class="form-label">Status</label>
                                <x-select-all-status :statusAll=$statusAll/>
                            </div>
                            <div class="mx-5">
                                <label for="Pernoite" class="form-label">Pernoite</label>
                                <input type="checkbox" name="diaria" class="form-check" id="Pernoite">
                            </div>
                            <div>
                                @csrf
                                <input type="submit" value="Buscar" class="btn btn-primary">
                                <input type="submit" name="Reset" value="Limpar filtros" class="btn btn-danger">
                            </div>
                        </form>
                    </section>
                    <section>
                        <a href="{{ route('carga.create') }}" class="btn btn-primary my-2">Nova Carga</a>
                    </section>
                    @endif
                    <table class=" text-center align-items-center text-sm table-cargas">
                        <thead>
                            <tr class="border-secondary border">
                                @php
                                $array = [
                                    ['name' => 'Data', 'item' => 'created_at','class'=>''],
                                    ['name' => 'Remessa - OS', 'item' => 'remessa','class'=>'col-2'],
                                    // ['name' => 'OS', 'item' => 'os','class'=>'col-1'],
                                    ['name' => 'Motorista', 'item' => 'motorista_id','class'=>'col-1'],
                                    ['name' => 'Origem', 'item' => 'filial_id','class'=>'col-1'],
                                    ['name' => 'Destino', 'item' => 'destino','class'=>'col-1'],
                                    ['name' => 'Veiculo', 'item' => 'veiculo_id','class'=>'col-1'],
                                    ['name' => 'Progresso', 'item' => '','class'=>'col-2'],
                                    ['name' => 'Entregas', 'item' => '','class'=>'col-1'],
                                    ['name' => 'Frete', 'item' => '','class'=>'col-1'],
                                    // ['name' => 'Diaria', 'item' => 'diaria','class'=>'col-1'],
                                    ['name' => 'Arquivos', 'item' => '','class'=>'col-1'],
                                    ['name' => 'Status', 'item' => 'status_id','class'=>'col-2'],
                                ];
                                @endphp
                                <th class="p-2">-</th>
                                <th><input type="checkbox" name="" id=""></th>

                                @foreach ($array as $item)
                                <th class="{{ $item['class'] }}">
                                    @if (session()->has('order-by-items-item') && session('order-by-items-item')==$item['item'] && session()->has('order-by-items-order') && session('order-by-items-order')=='asc')
                                        <a href="?item={{ $item['item'] }}&order=asc" class="order-by-items"><i class="fa-solid fa-arrow-up-wide-short text-info"></i></a>
                                    @else
                                        <a href="?item={{ $item['item'] }}&order=asc" class="order-by-items"><i class="fa-solid fa-arrow-up-wide-short"></i></a>
                                    @endif

                                    {{ $item['name'] }}
                                    @if (session()->has('order-by-items-item') && session('order-by-items-item')==$item['item'] && session()->has('order-by-items-order') && session('order-by-items-order')=='desc')
                                        <a href="?item={{ $item['item'] }}&order=desc" class="order-by-items"><i class="fa-solid fa-arrow-down-wide-short text-info"></i></a>
                                    @else
                                        <a href="?item={{ $item['item'] }}&order=desc" class="order-by-items"><i class="fa-solid fa-arrow-down-wide-short"></i></a>
                                    @endif
                                </th>
                            @endforeach

                                {{-- <th>Data</th>
                                <th>Remessa</th>
                                <th>OS</th> --}}
                                {{-- <th class="col-2">Motorista</th> --}}
                                {{-- <th class="col-2">Origem</th>
                                <th class="col-2">Destino</th> --}}
                                {{-- <th>Agenda</th> --}}
                                {{-- <th class="">Veículo</th> --}}
                                {{-- <th class="col-2">Notas</th> --}}
                                {{-- <th>Entregas</th> --}}
                                {{-- <th class="col-1">Frete</th> --}}
                                {{-- <th>Diária</th> --}}
                                {{-- <th class="col-2">Status</th> --}}
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
                                    <td class="d-flex justify-between px-5">
                                        @if (isset($carga->remessa))
                                        <a
                                        href="{{ route('carga.show', ['carga' => $carga->id]) }}" class="click_botao_direito position-relative" copy="{{ $carga->remessa }}"
                                        title="Clique com o botao direito do mouse para copiar texto">{{ isset($carga->remessa)?$carga->remessa:'editar' }}</a>
                                        @else
                                        <a
                                        href="{{ route('carga.edit', ['carga' => $carga->id]) }}" class="click_botao_direito position-relative" copy="{{ $carga->remessa }}"
                                        title="Clique com o botao direito do mouse para copiar texto">{{ isset($carga->remessa)?$carga->remessa:'editar' }}</a>
                                        @endif
                                        {{-- <a
                                            href="{{ route('carga.show', ['carga' => $carga->id]) }}" class="click_botao_direito position-relative" copy="{{ $carga->remessa }}"
                                            title="Clique com o botao direito do mouse para copiar texto">{{ isset($carga->remessa)?$carga->remessa:'editar' }}</a> --}}
                                    {{-- </td>
                                    <td> --}} -
                                        @if (isset($carga->os))
                                        <a
                                        href="{{ route('carga.show', ['carga' => $carga->id]) }}" class="click_botao_direito position-relative" copy="{{ $carga->os }}"
                                        title="Clique com o botao direito do mouse para copiar texto">{{ isset($carga->os)?$carga->os:'editar' }}</a>
                                        @else
                                        <a
                                        href="{{ route('carga.edit', ['carga' => $carga->id]) }}" class="click_botao_direito position-relative" copy="{{ $carga->os }}"
                                        title="Clique com o botao direito do mouse para copiar texto">{{ isset($carga->os)?$carga->os:'editar' }}</a>
                                        @endif

                                    </td>
                                    <td><div class="div-overflow-carga" title="{{ isset($carga->motorista->name)?$carga->motorista->name:'-' }}">
                                        {{ isset($carga->motorista->name)?$carga->motorista->name:'-'  }}</div></td>
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
                                    <td>@forelse ($carga->docs as $item)
                                        @switch($item->tipo)
                                            @case('Canhoto')
                                                <i class="fa-regular fa-file-lines" title="Canhoto"></i>
                                                @break
                                            @case('Assinante')
                                                <i class="fa-solid fa-file-pen" title="Assinante"></i>
                                                @break
                                            @case('Descarrego')
                                                {{-- <i class="fa-solid fa-dolly"></i> --}}
                                                <i class="fa-solid fa-file-invoice-dollar" title="Descarrego"></i>
                                                @break
                                            @default
                                                <i class="fa-solid fa-file" title="Outros Documentos"></i>
                                                @break
                                        @endswitch
                                    @empty
                                        Sem Anexos
                                    @endforelse</td>
                                    {{-- <td class="cursor-pointer" title="Clique para adicionar diária"><a href="{{ route('formDiaria',['carga'=>$carga->id]) }}" class="add-diaria add-diaria-{{ $carga->id }}">{{ $carga->diaria }}</a></td> --}}
                                    @php
                                        $status = $carga->getStatus();
                                        $permissionColaborador = array("Aguardando","Pendente","Rota", "Finalizada","Cancelada");
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
                                    @endphp font-bold ">
                                        <form action="{{ route('UpdateStatusCarga',['carga'=>$carga->id]) }}" method="post" class="" name="UpdateStatusCarga_{{ $carga->id }}">
                                            <div class="col-12">
                                                <select name="StatusCarga_{{ $carga->id }}" id="Carga_{{ $carga->id }}" route="{{ route('UpdateStatusCarga',['carga'=>$carga->id]) }}" class=" form-control select-index-carga">
                                                    <option value="">Selecione o Status da Carga</option>
                                                    @foreach ($carga->getAllStatus() as $item)
                                                    @php
                                                        if((Auth::user()->roles()->first()->name== 'tenant-colaborador' || Auth::user()->roles()->first()->name== 'colaborador')
                                                            && in_array($item->name,$permissionColaborador)){
                                                            $disabledOption = 'disabled';
                                                        }else{
                                                            $disabledOption = '';
                                                        }
                                                    @endphp
                                                    @if (isset($status->descricao) && $status->id==$item->id)
                                                    <option value="{{ $item->id }}" selected {{ $disabledOption }}>{{ str_replace('Carga ','',$item->name) }}</option>
                                                    @else
                                                    <option value="{{ $item->id }}" {{ $disabledOption }}>{{ str_replace('Carga ','',$item->name) }}</option>
                                                    @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                            @csrf
                                        </form>
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
                                                    <li><a href="{{ route('create.cte',['carga'=>$carga->id]) }}" class="btn btn-primary">Emitir Cte</a></li>
                                                </ul>
                                            </div>
                                            <div class="tab-pane fade" id="contact_{{ $carga->id }}" role="tabpanel"
                                                aria-labelledby="contact-tab_{{ $carga->id }}">
                                                Observacoes da carga e etc
                                                <ul>
                                                @forelse ($carga->historico() as $item)
                                                    <li>{{ $item->descricao }}</li>
                                                    @php
                                                    $role = Auth::user()->roles()->first()->name;
                                                    @endphp
                                                    @if ($role == 'super-admin' || $role == 'tenant-admin' || $role == 'admin' || $role == 'tenant-admin-master')
                                                        <li>{{ $item->dados }}</li>
                                                    @endif
                                                @empty
                                                   Não há Historico registrado
                                                @endforelse
                                                </ul>
                                            </div>
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
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <section class="index-cargas-mobile">
                        <ul class="col-12">
                            @foreach ($cargas as $carga)
                            <li class="d-flex border border-black rounded mb-3">
                                <ul class="col-3">
                                    <li>Data</li>
                                    <li>Remessa - OS</li>
                                    <li>Motorista</li>
                                    <li>Origem</li>
                                    <li>Destino</li>
                                    <li>Veiculo</li>
                                    <li>Progresso</li>
                                    <li>Status</li>
                                    <li>Ação</li>
                                </ul>
                                <ul class="col-9">
                                    <li>{{ date('d/m/Y', strtotime($carga->data)) }}</li>
                                    <li>{{ $carga->remessa }} - {{ $carga->os }}</li>
                                    <li>{{ isset($carga->motorista->name)?$carga->motorista->name:'-' }}</li>
                                    <li>{{ $carga->filial->nome_fantasia }}</li>
                                    <li>{{ $carga->destino }}</li>
                                    <li>{{ isset($carga->veiculo->placa) ? $carga->veiculo->placa : '' }}</li>
                                    <li class="d-flex align-items-center">
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
                                    </li>
                                    @php
                                        $status = $carga->getStatus();
                                        $permissionColaborador = array("Aguardando","Pendente","Rota", "Finalizada","Cancelada");
                                    @endphp
                                    <li title="{{ $status->descricao }}" class="@php
                                        if($status->name =='Rota'){
                                            echo 'text-success';
                                        }else if($status->name =='Finalizada'){
                                            echo 'text-dark';
                                        }else if($status->name =='Aguardando'){
                                            echo 'text-warning';
                                        }else{
                                            echo 'text-primary';
                                        }
                                    @endphp font-bold ">
                                        <form action="{{ route('UpdateStatusCarga',['carga'=>$carga->id]) }}" method="post" class="" name="UpdateStatusCarga_{{ $carga->id }}">
                                            <div class="col-12">
                                                <select name="StatusCarga_{{ $carga->id }}" id="Carga_{{ $carga->id }}" route="{{ route('UpdateStatusCarga',['carga'=>$carga->id]) }}" class=" form-control select-index-carga">
                                                    <option value="">Selecione o Status da Carga</option>
                                                    @foreach ($carga->getAllStatus() as $item)
                                                    @php
                                                        if((Auth::user()->roles()->first()->name== 'tenant-colaborador' || Auth::user()->roles()->first()->name== 'colaborador')
                                                            && in_array($item->name,$permissionColaborador)){
                                                            $disabledOption = 'disabled';
                                                        }else{
                                                            $disabledOption = '';
                                                        }
                                                    @endphp
                                                    @if (isset($status->descricao) && $status->id==$item->id)
                                                    <option value="{{ $item->id }}" selected {{ $disabledOption }}>{{ str_replace('Carga ','',$item->name) }}</option>
                                                    @else
                                                    <option value="{{ $item->id }}" {{ $disabledOption }}>{{ str_replace('Carga ','',$item->name) }}</option>
                                                    @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                            @csrf
                                        </form>
                                    </li>
                                    <li>
                                        @if ($status->id == $carga->getStatusId('Carregado') || $status->id == $carga->getStatusId('Notas') || $status->id == $carga->getStatusId('Aguardando'))
                                            <a href="" class="btn btn-primary btn-seguir-viagem" data-toggle="modal" Carga="{{ $carga->id }}">Seguir viagem</a>
                                            <div class="modal fade" id="Modal_{{ $carga->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                  <div class="modal-content">
                                                    <div class="modal-header">
                                                      <h5 class="modal-title" id="exampleModalLabel">Deseja Seguir viagem para qual destino?</h5>
                                                      {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                      </button> --}}
                                                    </div>
                                                    <div class="modal-body">
                                                        <a href="{{ route('SeguirViagem',['carga'=>$carga->id]) }}" destino="Cliente" class="btn btn-primary destino-viagem">Cliente</a>
                                                        @foreach (Auth::user()->empresa->first()->localapoios as $item)
                                                        {{-- Auth::user()->empresa->first()->localapoios --}}
                                                        <a href="{{ route('SeguirViagem',['carga'=>$carga->id]) }}" destino="{{ $item->name }}" class="btn btn-primary destino-viagem">{{ $item->name }}</a>
                                                        @endforeach
                                                    </div>
                                                    <div class="modal-footer">
                                                      <button type="button" class="btn btn-danger" data-dismiss="modal" class="close-modal-viagem">Cancelar</button>
                                                      {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
                                                    </div>
                                                  </div>
                                                </div>
                                              </div>
                                        @endif
                                        <a href="{{ route('carga.show',['carga'=>$carga->id]) }}" class="btn btn-primary">Consultar</a>
                                    </li>
                                </ul>
                            </li>
                            @endforeach
                        </ul>
                    </section>
                        <div class="my-2">
                            <div class="col-12 text-center">
                                <b>Paginação</b>
                                <div class="col-12 d-flex justify-center">
                                    @php
                                        $arrayPaginate = [
                                            ['paginate' => 1],
                                            ['paginate' => 2],
                                            ['paginate' => 4],
                                            ['paginate' => 5],
                                            ['paginate' => 10],
                                            ['paginate' => 20],
                                            ['paginate' => 30],
                                            ['paginate' => 50],
                                            ['paginate' => 100],
                                            ['paginate' => 200],
                                        ];
                                    @endphp
                                    @foreach ($arrayPaginate as $item)
                                        @if (session()->has('paginate-by-page') && session('paginate-by-page') == $item['paginate'])
                                            <a href="?paginate={{ $item['paginate'] }}"
                                                id="Paginate_{{ $item['paginate'] }}"
                                                class="mx-2 paginate-by-page paginate-by-page-color">{{ $item['paginate'] }}</a>
                                        @else
                                            <a href="?paginate={{ $item['paginate'] }}"
                                                id="Paginate_{{ $item['paginate'] }}"
                                                class="mx-2 paginate-by-page">{{ $item['paginate'] }}</a>
                                        @endif
                                    @endforeach

                                </div>
                                {{ $cargas->links() }}
                        </div>{{-- fim paginacao --}}
                    </div>
                </div>
            </div>

        </div>

    </div>
</x-app-layout>
