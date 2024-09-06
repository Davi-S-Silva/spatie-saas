<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Empresas') }}
        </h2>
    </x-slot>
    <div class="py-1">
        <div class="mx-auto px-1">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="card col-12 p-2">
                    <header class="h4">Configurações da Empresa</header>
                    {{-- <div>
                        <h1 class="font-bold">{{ $empresa }}</h1>
                    </div> --}}
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <button class="nav-link active" id="nav-minha-empresa-tab" data-bs-toggle="tab"
                                data-bs-target="#nav-minha-empresa" type="button" role="tab"
                                aria-controls="nav-minha-empresa" aria-selected="true">Minha Empresa</button>
                            <button class="nav-link" id="nav-tributario-tab" data-bs-toggle="tab"
                                data-bs-target="#nav-tributario" type="button" role="tab" aria-controls="nav-tributario"
                                aria-selected="false">Tributário</button>
                            <button class="nav-link" id="nav-documentos-tab" data-bs-toggle="tab"
                                data-bs-target="#nav-documentos" type="button" role="tab" aria-controls="nav-documentos"
                                aria-selected="false">Documentos Fiscais</button>
                        </div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-minha-empresa" role="tabpanel"
                            aria-labelledby="nav-minha-empresa-tab">
                            <form>
                                <fieldset disabled>
                                    <div>
                                        <header class="h4 text-secondary ml-2">Identificação</header>

                                        <div class="d-flex justify-start flex-wrap col-12">
                                            <div class="d-flex col-12">
                                                <div class="col-lg-4 col-md-5 ml-2 col-12">
                                                    <label for="" class="form-label">Razão Social</label>
                                                    <input type="text" name="" id=""
                                                        value="{{ $empresa->nome }}" class="form-control">
                                                </div>
                                                <div class="col-lg-4 col-md-5 ml-2 col-12">
                                                    <label for="" class="form-label">Nome Fantasia</label>
                                                    <input type="text" name="" id=""
                                                        value="{{ $empresa->nome_fantasia }}" class="form-control">
                                                </div>
                                            </div>
                                            <div class="d-flex col-12">
                                                <div class="col-lg-3 col-md-4 ml-2 col-12">
                                                    <label for="" class="form-label">Pessoa
                                                        Física/Jurídica</label>
                                                    @php
                                                        $tipodocempresa = $empresa->tipo_doc;
                                                    @endphp
                                                    <x-select-tipo-doc :tipodocempresa=$tipodocempresa />
                                                </div>
                                                <div class="col-lg-3 col-md-4 ml-2 col-12">
                                                    <label for="" class="form-label">CPF/CNPJ</label>
                                                    <input type="text" name="" id=""
                                                        value="{{ $empresa->doc }}" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <header class="h4 text-secondary ml-2">Contatos</header>
                                        <div>
                                            {{-- {{ print_r($empresa->contatos()->first()->getAttributes()) }} --}}
                                            @foreach ($empresa->contatos as $item)
                                            <div class="col-3">
                                                @include('contato.form-contato', ['contato' => $item])
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div>
                                        <header class="h4 text-secondary ml-2">Endereco</header>
                                        <div>
                                            {{-- {{ print_r($empresa->contatos()->first()->getAttributes()) }} --}}
                                            @foreach ($empresa->enderecos as $item)
                                            <div class="col-3">
                                                @include('endereco.form-endereco', ['endereco' => $item])
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </fieldset>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="nav-tributario" role="tabpanel" aria-labelledby="nav-tributario-tab">

                            <form action="" method="post">
                                <fieldset>
                                    <div class="col-12 col-sm-3">
                                        <label for="" class="form-label">
                                            Código de regime tributário - CRT
                                        </label>
                                        <select name="crt" id="" class="form-control">
                                            <option value="">Selecione o crt</option>
                                            <option value="1">Simples Nacional</option>
                                            <option value="2">Simples Nacional - excesso de sublimite de receita bruta</option>
                                            <option value="3">Regime Normal</option>
                                        </select>
                                    </div>
                                    <div class="col-12 col-sm-3">
                                        <label for="" class="form-label">
                                            Regime especial de tributação-Serviços
                                        </label>
                                        <select name="crt" id="" class="form-control">
                                            <option value="">Selecione o regime</option>
                                            <option value="1">Nenhum</option>
                                            <option value="2">Cooperativa</option>
                                            <option value="3">Estimativa</option>
                                            <option value="4">Micro Empresa Municipal</option>
                                            <option value="5">Notário ou Registrador</option>
                                            <option value="6">Sociedade Profissional</option>
                                            <option value="7">Microempresario Individual(MEI)</option>
                                            <option value="8">Microempresario ou Empresa de Pequeno Porte(EPP)</option>
                                            <option value="9">Tributação Normal</option>
                                        </select>
                                    </div>
                                    <div class="col-12 col-sm-3">
                                        <label for="" class="form-label">
                                            Opção do Simples Nacional
                                        </label>
                                        <select name="crt" id="" class="form-control">
                                            <option value="">Selecione a opção</option>
                                            <option value="1">Não Optante</option>
                                            <option value="2">Optante - Microempreendedor Individual (MEI)</option>
                                            <option value="3">Optante - Microempresa ou Empresa de Pequeno Porte (EPP)</option>
                                        </select>
                                    </div>
                                    <div class="col-12 col-sm-3">
                                        <label for="" class="form-label">
                                            Regime de Apuração tributária Simples Nacional
                                        </label>
                                        <select name="crt" id="" class="form-control">
                                            <option value="">Selecione a opção</option>
                                            <option value="1">1 - Regime de apuração dos tributos federais e municipal pelo SN</option>
                                            <option value="2">2 - Regime de apuração dos tributos federais pelo SN e o ISSQN pela NFS-e conforme respectiva legislação municipal do tributo</option>
                                            <option value="3">3 - Regime de apuração dos tributos federais e municipal pela NFS-e conforme respectiva lesgilação federal e municipal de cada tributo</option>
                                        </select>
                                    </div>
                                    <div class="col-12 col-sm-3">
                                        <label for="" class="form-label">
                                            Código nacional de atividades econômica - CNAE
                                        </label>
                                        <select name="crt" id="" class="form-control">
                                            <option value="">Selecione a opção</option>
                                            @foreach ($cnaes as $cnae)
                                                <option value="{{ $cnae->id }}">{{ $cnae->codigo_cnae }} - {{ $cnae->desc_cnae }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-12 col-sm-3">
                                        <label for="" class="form-label">Inscrição Municipal</label>
                                        <input type="number" name="IM" id="" class="form-control rounded border">
                                    </div>
                                    <div class="col-12 col-sm-3">
                                        <label for="" class="form-label">Inscrição Estadual</label>
                                        <input type="number" name="IE" id="" class="form-control rounded border">
                                    </div>
                                </fieldset>
                            </form>

                        </div>
                        <div class="tab-pane fade" id="nav-documentos" role="tabpanel" aria-labelledby="nav-documentos-tab">
                            <form action="" method="post">
                                <fieldset>
                                    <div>
                                        <header>CTe</header>
                                        <div>
                                            <div>
                                                <label for="" class="form-label">Série do CTe</label>
                                                <input type="number" name="SerieCte" id="">
                                            </div>
                                            <div>
                                                <label for="" class="form-label">Próximo número do CTe</label>
                                                <input type="number" name="ProxNumCte" id="">
                                            </div>
                                            <div>
                                                <label for="" class="form-label">Versão do XML</label>
                                                <select name="VersaoCte" id="">
                                                    <option value="">Selecione a Versão</option>
                                                    <option value="1">2.00</option>
                                                    <option value="2">3.00</option>
                                                    <option value="3">4.00</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <header>MDFe</header>
                                        <div>
                                            <div>
                                                <label for="" class="form-label">Série do MDFe</label>
                                                <input type="number" name="SerieMdfe" id="">
                                            </div>
                                            <div>
                                                <label for="" class="form-label">Próximo número do MDFe</label>
                                                <input type="number" name="ProxNumMdfe" id="">
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                            </form>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
{{--

<div>
                        <h1 class="font-bold">Endereco</h1>
                        @forelse ($empresa->enderecos as $endereco)
                            {{$endereco->endereco}}
                        @empty
                            endereco nao cadastrado
                        @endforelse
                    </div>
                    <div>
                        <h1>Locais de apoio</h1>

                        @forelse ($empresa->localapoios as $apoio)
                            <ul class="px-3 py-1">
                                <li>{{ $apoio->name }}</li>
                            </ul>
                        @empty
                            sem local cadastrado.
                        @endforelse
                        <div>
                            <a href="{{ route('localapoio.create') }}" class="btn btn-primary">Add Local de Apoio</a>
                        </div>
                    </div>
                    <div>
                        <label for="">Certificados</label>
                        @foreach ($empresa->certificate as $certificado)
                            <ul class="px-3 py-1">
                                <li>{{ $certificado->name }}</li>
                            </ul>
                        @endforeach
                    </div>
                    @foreach ($certificados as $certificado)
                        <ul>
                            <li>{{ $certificado->empresa->name }}</li>
                        </ul>
                    @endforeach
                    <div>
                        <a href="{{ route('empresa.edit', ['empresa' => $empresa->id]) }}"
                            class="btn btn-primary m-2">Editar</a>
                    </div>
--}}
