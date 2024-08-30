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
                            <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab"
                                data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile"
                                aria-selected="false">Profile</button>
                            <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab"
                                data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact"
                                aria-selected="false">Contact</button>
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
                        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                            ...</div>
                        <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                            ...</div>
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
