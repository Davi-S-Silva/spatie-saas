<fieldset>
    <legend class="col-12">
        <header>
            Conhecimento de Transporte Eletrônico
        </header>
        <small>Modal Rodoviário - Versão 4.00</small>
    </legend>
    <section>
        <ul class="nav nav-tabs" id="CteTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="geral-tab" data-bs-toggle="tab" data-bs-target="#geral" type="button"
                    role="tab" aria-controls="geral" aria-selected="true">Geral</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="info-carga-tab" data-bs-toggle="tab" data-bs-target="#info-carga"
                    type="button" role="tab" aria-controls="info-carga" aria-selected="false">Informação da
                    Carga</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="rodoviario-tab" data-bs-toggle="tab" data-bs-target="#rodoviario"
                    type="button" role="tab" aria-controls="rodoviario" aria-selected="false">Rodoviário</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="info-doc-tab" data-bs-toggle="tab" data-bs-target="#info-doc"
                    type="button" role="tab" aria-controls="info-doc" aria-selected="false">Informações de
                    Documentos</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="cobranca-tab" data-bs-toggle="tab" data-bs-target="#cobranca"
                    type="button" role="tab" aria-controls="cobranca" aria-selected="false">Cobranças</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="fatura-tab" data-bs-toggle="tab" data-bs-target="#fatura" type="button"
                    role="tab" aria-controls="fatura" aria-selected="false">Fatura</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="complemento-tab" data-bs-toggle="tab" data-bs-target="#complemento"
                    type="button" role="tab" aria-controls="complemento" aria-selected="false">Compl.
                    Valores</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="substituicao-tab" data-bs-toggle="tab" data-bs-target="#substituicao"
                    type="button" role="tab" aria-controls="substituicao"
                    aria-selected="false">Substituição</button>
            </li>
        </ul>
        <div class="tab-content" id="CteTabContent">
            <div class="tab-pane fade show active" id="geral" role="tabpanel" aria-labelledby="geral-tab">
                <section>
                    <header  class="h5">Informações Gerais</header>
                    <div class="col-12 d-flex justify-between">
                        <div class="col-md-3 col-12">
                            <x-cte.tipo-cte :required=true :tiposCte=$tiposCte />
                        </div>
                        <div class="col-md-3 col-12">
                            <x-cte.tipo-servico-cte :required=true :tipoServicoCte=$tipoServicoCte />
                        </div>
                        <div class="col-md-3 col-12">
                            <x-cte.tipo-emissao-cte :required=true :tipoEmissaoCte=$TipoEmissaoCte />
                        </div>
                    </div>
                    <div class="col-12 d-flex justify-between flex-wrap">
                        <div class="col-12 d-flex justify-between">
                            <div class="col-12 col-md-4">
                                <x-cfop :required=true :cfop=$cfop />
                            </div>
                            <div class="col-12 col-md-5">
                                <label for="" class="form-label">Natureza da Operação</label>
                                <input type="text" name="NaturezaOp" id="" class="form-control rounded border-black" required value="PREST DE SERVIÇO DE TRANSP A ESTABELECIMENTO COMERCIAL">
                            </div>
                        </div>
                        <div class="col-12 d-flex justify-between">
                            <div class="col-12 col-md-5">
                                <label for="" class="form-label">Cidade do Inicio de Prestação</label>
                                @php
                                    $name = 'cidade_inicio';
                                    $cidade = $carga->filial->enderecos->first()->cidade->id;
                                @endphp
                                <x-select-cidade :cidades=$cidades :endereco=$cidade  :name=$name :required=true/>
                            </div>
                            <div class="col-12 col-md-5">
                                <label for="" class="form-label">Cidade do Final de Prestação</label>
                                @php
                                    $name = 'cidade_fim';
                                    echo $cidade= $carga->distanceCity()->id;
                                    // dd($cidade);
                                @endphp
                                <x-select-cidade :cidades=$cidades :endereco=$cidade  :name=$name :required=true/>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="col-12 d-flex justify-between">
                                <div class="col-12 col-md-3">
                                    <label for="" class="form-label">Tomador do Serviço</label>
                                    <select name="TomadorServico" id="" class="form-control border-black" required>
                                        <option value="">selecione o tomador de serviço</option>
                                        <option value="0" selected>0 - Remetente</option>
                                        <option value="1">1 - Expedido</option>
                                        <option value="2">2 - Recebedor</option>
                                        <option value="3">3 - Destinatários</option>
                                        <option value="4">4 - Outros</option>
                                    </select>
                                </div>
                                <div class="col-12 col-md-3">
                                    <label for="" class="form-label">Remetente</label>
                                    <input type="text" name="Remetente" id="" class="form-control rounded border-black" required placeholder="Insira CPF/CNPJ" value="{{ $carga->filial->cnpj }} - {{ $carga->filial->razao_social }}">
                                </div>
                                <div class="col-12 col-md-3">
                                    <label for="" class="form-label">Destinatario</label>
                                    <input type="text" name="Destinatario" id="" class="form-control rounded border-black" required placeholder="Insira CPF/CNPJ">
                                </div>
                            </div>
                            <div class="col-12 d-flex justify-between">
                                <div class="col-12 col-md-3">
                                    <label for="" class="form-label">Recebedor</label>
                                    <input type="text" name="Recebedor" id="" class="form-control rounded border-black" placeholder="Insira CPF/CNPJ">
                                </div>
                                <div class="col-12 col-md-3">
                                    <label for="" class="form-label">Expedidor</label>
                                    <input type="text" name="Expedidor" id="" class="form-control rounded border-black" placeholder="Insira CPF/CNPJ">
                                </div>
                                <div class="col-12 col-md-3">
                                    <label for="" class="form-label">Tomador</label>
                                    <input type="text" name="Tomador" id="" class="form-control rounded border-black" placeholder="Insira CPF/CNPJ">
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <div class="tab-pane fade" id="info-carga" role="tabpanel" aria-labelledby="info-carga-tab">
                <section>
                    <header  class="h5">Carga</header>
                    <div class="d-flex justify-between col-12">
                        <div class="col-12 col-md-3">
                            <label for="" class="form-label">Valor Carga</label>
                            <input type="text" name="ValorCarga" id="" class="form-control rounded border-black" required placeholder="Digite/Cole o valor da carga">
                        </div>
                        <div class="col-12 col-md-3">
                            <label for="" class="form-label">Produto Predominante</label>
                            <input type="text" name="ProdPred" id="" class="form-control rounded border-black" required placeholder="Digite o Produto Predominante">
                        </div>
                        <div class="col-12 col-md-3">
                            <label for="" class="form-label">Outras Características do Produto</label>
                            <input type="text" name="OutCaracProd" id="" class="form-control rounded border-black"placeholder="Digite o Caractristas Extras do produto">
                        </div>
                    </div>
                    <div>
                        <header  class="h5">Quantidade da Carga</header>
                        <div>
                            <table class="col-12 text-center">
                                <thead class="col-12">
                                    <tr class="col-12">
                                        <th>-</th>
                                        <th class="col-1">Cod. Unid. Medida</th>
                                        <th class="col-8">Tipo de Medida</th>
                                        <th class="col-2">Qtde da Carga</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr id="CopyTrQtdCarga" class="">
                                        <td><i class="fa-solid fa-trash"></i></td>
                                        <td><select name="CodUnidCarga" id="" required>
                                                <option value=""> </option> {{-- 00-M3; 01-KG; 02-TON; 03-UNIDADE; 04-LITROS; 05-MMBTU --}}
                                                <option value="0">00 -M3</option>
                                                <option value="1">01 - KG</option>
                                                <option value="2">02 - TON</option>
                                                <option value="3">03 - UNIDADE</option>
                                                <option value="4">04 - LITROS</option>
                                                <option value="5">05 - MMBTU</option>
                                            </select></td>
                                        <td><input type="text" name="TipoMedida" id="" class="col-12"></td>
                                        <td><input type="text" name="QtdCarga" id="" class="col-12" required></td>
                                        <td><a href=""><i class="fa-solid fa-square-plus"></i></a></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>
            </div>
            <div class="tab-pane fade" id="rodoviario" role="tabpanel" aria-labelledby="rodoviario-tab">
                <section>
                    <header class="h5">Modal Rodoviário</header>
                    <div class="col-12 col-md-3">
                        <label for="" class="form-label">RNTRC</label>
                        <input type="text" name="RNTRC" id="" class="form-control rounded border-black">
                    </div>
                </section>
            </div>
            <div class="tab-pane fade" id="info-doc" role="tabpanel" aria-labelledby="info-doc-tab">
                <section>
                    <header  class="h5">Documentos</header>
                    <div class="d-flex">
                        <label for="" class="form-label">Usar Notas: </label>
                        <div class="mx-5">
                            <label for="UmaNota" >1 Nota</label>
                            <input type="radio" name="NotaCteSelect" id="UmaNota" value="uma" required>
                        </div>
                        <div>
                            <label for="AllNotas" >Todas as Notas</label>
                            <input type="radio" name="NotaCteSelect" id="AllNotas" value="all" required>
                        </div>
                    </div>
                    <table class="col-12 text-center">
                        <thead class="col-12">
                            <tr class="col-12">
                                <th>-</th>
                                <th class="col-11">Chave da NF-e</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($carga->notas()->get() as $item)
                                <tr>
                                    <td><a href=""><i class="fa-solid fa-trash"></i></a></td>
                                <td><input type="text" name="NfeChaves[]" id="" class="col-12" required placeholder="Digite/Cole a Chave de Acesso da Nota Fiscal Eletronica" value="{{ $item->chave_acesso }}"></td>
                                <td><a href=""><i class="fa-solid fa-square-plus"></i></a></td>
                                </tr>
                            @endforeach
                            <tr id="CopyTrChaveNfe">
                                <td><a href=""><i class="fa-solid fa-trash"></i></a></td>
                                <td><input type="text" name="NfeChaves[]" id="" class="col-12" placeholder="Digite/Cole a Chave de Acesso da Nota Fiscal Eletronica"></td>
                                <td><a href=""><i class="fa-solid fa-square-plus"></i></a></td>
                            </tr>
                        </tbody>
                    </table>
                </section>
            </div>
            <div class="tab-pane fade" id="cobranca" role="tabpanel" aria-labelledby="cobranca-tab">
                <section>
                    <header  class="h5">Serviços e Impostos</header>
                    <div class="col-12 d-flex justify-between">
                        <div class="col-12 col-md-3">
                            <label for="" class="form-label">Valor da Prestação de Serviços</label>
                            <input type="text" name="ValorPrestacao" id="" class="form-control rounded border-black">
                        </div>
                        <div class="col-12 col-md-3">
                            <label for="" class="form-label">Valor a Receber</label>
                            <input type="text" name="ValorReceber" id="" class="form-control rounded border-black">
                        </div>
                        <div class="col-12 col-md-3">
                            <label for="" class="form-label">Valor aproximado dos tributos</label>
                            <input type="text" name="ValorAprxTributos" id="" class="form-control rounded border-black">
                        </div>
                    </div>
                    <div class="col-12">
                        <header  class="h5">ICMS</header>
                        <div class="col-12 d-flex justify-between">
                            <div class="col-12 col-md-2">
                                <x-cst :required=true :cst=$cst />
                            </div>
                            <div class="col-12 col-md-2">
                                <label for="" class="form-label">Base de Cálculo ICMS</label>
                                <input type="text" name="vBC" id="" class="form-control rounded border-black">
                            </div>
                            <div class="col-12 col-md-2">
                                <label for="" class="form-label">Alíquota ICMS</label>
                                <input type="text" name="pBC" id="" class="form-control rounded border-black">
                            </div>
                            <div class="col-12 col-md-2">
                                <label for="" class="form-label">Valor ICMS</label>
                                <input type="text" name="vBC" id="" class="form-control rounded border-black">
                            </div>
                        </div>
                    </div>
                    <div>
                        <header  class="h5">Informações Adicionais</header>
                        <div>
                            <label for="" class="form-label">Observações Gerais</label>
                            <div class="col-12" >
                                <textarea name="ObsGeral" id="" cols=""rows="10" class="form-control rounded border-black"></textarea>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <div class="tab-pane fade" id="fatura" role="tabpanel" aria-labelledby="fatura-tab">...</div>
            <div class="tab-pane fade" id="complemento" role="tabpanel" aria-labelledby="complemento-tab">
                <section>
                    <header  class="h5">CT-e Compl. Valores</header>
                    <div>
                        <label for="" class="form-label">Chave de Acaesso CTe</label>
                        <input type="text" name="ChaveAcessoCte" id="">
                    </div>
                </section>
            </div>
            <div class="tab-pane fade" id="substituicao" role="tabpanel" aria-labelledby="substituicao-tab">...
            </div>
        </div>
        <div class="mt-5 d-flex justify-center">
            @csrf
            <a href="" class="btn btn-outline-dark mr-2"><i class="fa-solid fa-angles-left"></i> Voltar</a>
            <a href="" class="btn btn-outline-dark mr-2"><i class="fa-solid fa-check"></i> Validar</a>
            <a href="" class="btn btn-outline-dark mr-2"><i class="fa-solid fa-print"></i> Dacte</a>
            <a href="" class="btn btn-outline-dark mr-2"><i class="fa-regular fa-file-code"></i> XML</a>
            <a href="" class="btn btn-outline-dark mr-2"><i class="fa-solid fa-floppy-disk"></i> Salvar</a>
            <a href="" class="btn btn-outline-dark mr-2"><i class="fa-solid fa-paper-plane"></i> Emitir</a>
            <input type="submit" value="Salvar" class="btn btn-primary">
        </div>
    </section>
</fieldset>
