@php
    use App\Models\DistanceCity;
@endphp
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Show Carga') }}
        </h2>
    </x-slot>
    <div class="py-1">
        <div class="mx-auto px-1">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="card col-12 p-2">
                    <section class="d-flex justify-between flex-wrap">
                        <div class="col-3">
                            <ul>
                                <li>Cliente: {{ $carga->filial->razao_social }}</li>
                                <li>Empresa: {{ $carga->localApoio->name }}</li>
                                <li>Status: {{ $carga->getStatus()->descricao }}</li>
                                <li>Veiculo: <span class="click_botao_direito position-relative"
                                        copy="{{ isset($carga->veiculo) ? $carga->veiculo->placa : '' }}"
                                        title="Clique com o botao direito do mouse para copiar texto">{{ isset($carga->veiculo) ? $carga->veiculo->placa : '' }}</span>
                                </li>
                                <li>Frete: R$ <span class="click_botao_direito position-relative"
                                        copy="{{ number_format($carga->frete, 2, ',', '.') }}"
                                        title="Clique com o botao direito do mouse para copiar texto">{{ number_format($carga->frete, 2, ',', '.') }}</span>
                                </li>
                                <li>Destino: {{ $carga->destino }}</li>
                                <li>Remessa: <span class="click_botao_direito position-relative"
                                        copy="{{ $carga->remessa }}"
                                        title="Clique com o botao direito do mouse para copiar texto">{{ $carga->remessa }}</span>
                                </li>
                                <li>OS: <span class="click_botao_direito position-relative" copy="{{ $carga->os }}"
                                        title="Clique com o botao direito do mouse para copiar texto">{{ $carga->os }}</span>
                                </li>
                                <li>Entregas: {{ count($carga->paradas()) }}</li>
                                <li>Peso Bruto: <b><span class="click_botao_direito position-relative"
                                            copy="{{ number_format($carga->pesoBruto(), 2, ',', '.') }}"
                                            title="Clique com o botao direito do mouse para copiar texto">{{ number_format($carga->pesoBruto(), 2, ',', '.') }}</span></b>
                                </li>
                                <li>Peso Liquido: <b><span class="click_botao_direito position-relative"
                                            copy="{{ number_format($carga->pesoLiquido(), 2, ',', '.') }}"
                                            title="Clique com o botao direito do mouse para copiar texto">{{ number_format($carga->pesoLiquido(), 2, ',', '.') }}</span></b>
                                </li>
                                <li>Valor: <b>R$ <span class="click_botao_direito position-relative"
                                            copy="{{ number_format($carga->valor(), 2, ',', '.') }}"
                                            title="Clique com o botao direito do mouse para copiar texto">{{ number_format($carga->valor(), 2, ',', '.') }}</span></b>
                                </li>
                                <li>Quantidade: <b><span class="click_botao_direito position-relative"
                                            copy="{{ $carga->quantidade() }}"
                                            title="Clique com o botao direito do mouse para copiar texto">{{ $carga->quantidade() }}</span></b>
                                </li>
                                <li>
                                    <a href="{{ route('carga.edit', ['carga' => $carga->id]) }}"
                                        class="btn btn-info">Editar Carga</a>
                                </li>
                            </ul>
                            Cidades:
                            <ul class="d-flex">
                                @foreach ($carga->cidades() as $cidade)
                                    <li class="mr-4"> {{ $cidade->nome }}</li>
                                @endforeach
                            </ul>
                            {{-- @if (is_null($carga->frete) || $carga->frete == 0) --}}
                            <div class="col-5 d-flex justify-between align-items-center">
                                <a href="{{ route('carga.cidadeFrete', ['carga' => $carga->id]) }}"
                                    class="btn btn-primary cidade_frete m-5">Consultar Destino/Frete</a>
                                <div id="FreteCity" class="">
                                    <ul class="text-center">
                                        <li>Cidade: <span id="CidadeFrete"></span></li>
                                        <li>Frete: <span id="ValorFrete"></span></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="div_area_uploads_cargas col-9">
                            <ul>
                                <li>
                                    <form action="{{ route('carga.uploadCarga', ['carga' => $carga->id]) }}"
                                        method="post" name="FormAssinante" enctype="multipart/form-data">
                                        <div class="input-group mb-3">
                                            <label for="inputGroupFileAssinante"
                                                class="input-group-text">Assinante</label>
                                            <input type="file" name="FileAssinante" id="inputGroupFileAssinante"
                                                class="form-control">
                                            <input type="hidden" name="TipoFileCarga" value="Assinante">
                                            <input type="submit" value="Salvar" class="btn btn-primary">
                                        </div>
                                        @csrf
                                    </form>
                                </li>
                                <li>
                                    <form action="{{ route('carga.uploadCarga', ['carga' => $carga->id]) }}"
                                        method="post" name="FormOS" enctype="multipart/form-data">
                                        <div class="input-group mb-3">
                                            <label for="inputGroupFileOS" class="input-group-text">OS</label>
                                            <input type="file" name="FileOS" id="inputGroupFileOS"
                                                class="form-control">
                                            <input type="hidden" name="TipoFileCarga" value="OS">
                                            <input type="submit" value="Salvar" class="btn btn-primary">
                                        </div>
                                        @csrf
                                    </form>
                                </li>
                                <li>
                                    <form action="{{ route('carga.uploadCarga', ['carga' => $carga->id]) }}"
                                        method="post" name="FormDescarrego" enctype="multipart/form-data">
                                        <div class="input-group mb-3">
                                            <label for="inputGroupFileDescarrego"
                                                class="input-group-text">Descarrego</label>
                                            <input type="file" name="FileDescarrego" id="inputGroupFileDescarrego"
                                                class="form-control">
                                            <input type="hidden" name="TipoFileCarga" value="Descarrego">
                                            <input type="submit" value="Salvar" class="btn btn-primary">
                                        </div>
                                        @csrf
                                    </form>
                                </li>
                                <li>
                                    <form action="{{ route('carga.uploadCarga', ['carga' => $carga->id]) }}"
                                        method="post" name="FormAcessoArea" enctype="multipart/form-data">
                                        <div class="input-group mb-3">
                                            <label for="inputGroupFileAcessoArea" class="input-group-text">Acesso
                                                Área</label>
                                            <input type="file" name="FileAcessoArea" id="inputGroupFileAcessoArea"
                                                class="form-control">
                                            <input type="hidden" name="TipoFileCarga" value="AcessoArea">
                                            <input type="submit" value="Salvar" class="btn btn-primary">
                                        </div>
                                        @csrf
                                    </form>
                                </li>
                                <li>
                                    <form action="{{ route('carga.uploadCarga', ['carga' => $carga->id]) }}"
                                        method="post" name="FormCanhotos" enctype="multipart/form-data">
                                        <div class="input-group mb-3">
                                            <label for="inputGroupFileCanhotos"
                                                class="input-group-text">Canhotos</label>
                                            <input type="file" name="FileCanhotos" id="inputGroupFileCanhotos"
                                                class="form-control">
                                            <input type="hidden" name="TipoFileCarga" value="Canhotos">
                                            <input type="submit" value="Salvar" class="btn btn-primary">
                                        </div>
                                        @csrf
                                    </form>
                                </li>
                                <li>
                                    <form action="{{ route('carga.uploadCarga', ['carga' => $carga->id]) }}"
                                        method="post" name="FormDevolucao" enctype="multipart/form-data">
                                        <div class="input-group mb-3">
                                            <label for="inputGroupFileDevolucao"
                                                class="input-group-text">Devolucao</label>
                                            <input type="file" name="FileDevolucao" id="inputGroupFileDevolucao"
                                                class="form-control">
                                            <input type="hidden" name="TipoFileCarga" value="Devolucao">
                                            <input type="submit" value="Salvar" class="btn btn-primary">
                                        </div>
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                            <div>
                                <header>Arquivos</header>
                                <ul class="flex-column">
                                    @foreach ($carga->docs as $item)
                                        <li>Arquivo: {{ $item->name }}
                                            <a href="{{ $carga->getDoc($item->tipo) }}" target="_blank"><i
                                                    class="fa-solid fa-eye"></i></a>
                                            <a href="{{ $carga->getDoc($item->tipo,true) }}"><i
                                                    class="fa-solid fa-download"></i></a>
                                        </li>
                                    @endforeach
                                    <li><a href="{{ route('gerarListaDevolucao', ['carga' => $carga->id]) }}"
                                            target="_blank">Gerar Relatório de devolução</a></li>
                                    <li><a href="{{ route('gerarListaComprovante', ['carga' => $carga->id]) }}"
                                            target="_blank">Gerar Relatório de Comprovantes</a></li>
                                </ul>
                            </div>
                        </div>

                        @foreach ($carga->entregas()->with('veiculo', 'colaborador', 'getStatus')->get() as $item)
                            <a href="{{ route('entrega.show', ['entrega' => $item->id]) }}">
                                <ul>
                                    <li>{{ $item->colaborador->name }}</li>
                                    <li>{{ $item->veiculo->placa }}</li>
                                    <li>{{ $item->getStatus->descricao }}</li>
                                    <li>{{ date('d/m/Y H:i:s', strtotime($item->updated_at)) }}
                                    </li>
                                </ul>
                            </a>
                        @endforeach
                    </section>
                    {{-- @endif --}}
                    <div>
                        @php
                            $dados = $carga->produtos();
                        @endphp
                        @if (!is_null($dados))
                            <header>Produtos</header>
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
                    </div>
                    <div>
                        <header>Notas</header>
                        <div>
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
                                        <tr class="{{ $i % 2 == 0 ? 'bg-white' : '' }} border-secondary border">
                                            <td class="py-2"><span class="click_botao_direito position-relative"
                                                    copy="{{ $nota->nota }}"
                                                    title="Clique com o botao direito do mouse para copiar texto">{{ $nota->nota }}</span>
                                            </td>
                                            <td class="click_botao_direito position-relative"
                                                copy="{{ $nota->chave_acesso }}"
                                                title="Clique com o botao direito do mouse para copiar texto">
                                                {{ $nota->chave_acesso }}</td>
                                            <td>{{ $nota->filial->nome_fantasia }}</td>
                                            <td>
                                                <span class="click_botao_direito position-relative"
                                                    copy="{{ $nota->destinatario->cpf_cnpj }}"
                                                    title="Clique com o botao direito do mouse para copiar texto">{{ $nota->destinatario->cpf_cnpj }}
                                                </span>-
                                                {{ $nota->destinatario->nome_razao_social }}
                                            </td>
                                            <td class="col-3">
                                                {{ strtolower($nota->destinatario->endereco->endereco) }},
                                                {{ $nota->destinatario->endereco->numero }},
                                                {{ strtolower($nota->destinatario->endereco->bairro) }},
                                                <span class="click_botao_direito position-relative"
                                                    copy="{{ $nota->destinatario->endereco->cep }}"
                                                    title="Clique com o botao direito do mouse para copiar texto">{{ $nota->destinatario->endereco->cep }}</span>
                                                -
                                                {{ $nota->destinatario->endereco->cidade->nome }}
                                            </td>
                                            <td
                                                class="
                                        @php
if($nota->status->name =='Entregue'){
                                                echo 'text-success';
                                            }else if($nota->status->name =='Devolvida'){
                                                echo 'text-danger';
                                            }else{
                                                echo 'text-primary';
                                            } @endphp
                                        ">
                                                {{ $nota->status->descricao }}</td>
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

                        <section class="d-flex flex-wrap justify-around">
                            @foreach ($carga->notas()->with('destinatario', 'carga')->orderBy('destinatario_id', 'asc')->get() as $nota)
                                <div class="col-sm-3 m-2 col-11 d-flex justify-around align-items-center">
                                    <x-nota :nota=$nota />
                                </div>
                            @endforeach
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
