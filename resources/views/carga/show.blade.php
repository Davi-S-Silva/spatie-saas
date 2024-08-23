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
                    {{-- <form action="{{ route('carga.update',['carga'=>$carga->id]) }}" method="post" name="EditCarga" enctype="multipart/form-data">
                        @method('put')
                        @include('carga.form',['carga'=>$carga])
                    </form> --}}
                    {{-- <pre>
                        {{ print_r($carga->getAttributes()) }}
                    </pre> --}}
                    <ul>
                        <li>Cliente: {{ $carga->filial->razao_social }}</li>
                        <li>Empresa: {{ $carga->localApoio->name }}</li>
                        <li>Status: {{ $carga->getStatus()->descricao }}</li>
                        <li>Veiculo: {{ (isset($carga->veiculo))?$carga->veiculo->placa:'' }}</li>
                        <li>Frete: R$ {{ number_format($carga->frete,2,',','.') }}</li>
                        <li>Destino: {{ $carga->destino }}</li>
                        <li>Remessa: {{ $carga->remessa }}</li>
                        <li>OS: {{ $carga->os }}</li>
                        <li>Entregas: {{ count($carga->paradas()) }}</li>
                        <li>Peso Bruto: <b>{{ number_format($carga->pesoBruto(),2,',','.') }}</b></li>
                        <li>Peso Liquido: <b>{{ number_format($carga->pesoLiquido(),2,',','.') }}</b></li>
                        <li>Valor: <b>R$ {{ number_format($carga->valor(),2,',','.') }}</b></li>
                        <li>Quantidade: <b>{{ $carga->quantidade() }}</b></li>
                    </ul>
                    Cidades:
                    <ul class="d-flex">
                    @foreach ($carga->cidades() as $cidade)
                        <li class="mr-4"> {{ $cidade->nome }}</li>
                    @endforeach
                    </ul>
                    @if (is_null($carga->frete) || $carga->frete ==0)
                        <div class="col-5 d-flex justify-between align-items-center">
                            <a href="{{ route('carga.cidadeFrete',['carga'=>$carga->id]) }}" class="btn btn-primary cidade_frete m-5">Consultar Frete</a>
                            <div id="FreteCity" class="">
                                <ul class="text-center">
                                    <li>Cidade: <span id="CidadeFrete"></span></li>
                                    <li>Frete: <span id="ValorFrete"></span></li>
                                </ul>
                            </div>
                        </div>
                    @endif
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

                        <section class="d-flex flex-wrap justify-around">
                            @foreach ($carga->notas()->with('destinatario','carga')->orderBy('destinatario_id','asc')->get() as $nota)
                            <div class="col-sm-3 m-2 col-11 d-flex justify-around align-items-center">
                                <x-nota :nota=$nota/>
                            </div>
                            @endforeach
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
