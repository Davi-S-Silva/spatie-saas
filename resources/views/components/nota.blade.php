@php
    use App\Models\TipoPagamento;
    use App\Models\IndicacaoPagamento;
@endphp
<input type="checkbox" name="Notas[]"
class="form-check-input d-none text-secondary border-blue-300"
id="Checkbox_Nota_{{ $nota->id }}" value="{{ $nota->id }}">
<div class="col-10 p-2 nota-component d-flex flex-column justify-between position-relative">
    <div class="position-absolute bg-slate-400 area-info-nota-component" id="Info_Nota_{{ $nota->id }}">
        <div class="text-right p-2 bg-white border border-black">
            <i class="fa-regular fa-rectangle-xmark cursor-pointer close-area-info-nota-component" id="Close_Info_Nota_{{ $nota->id }}" nota={{ $nota->id }}></i>
        </div>
        <ul>
            <li><b>Usuário Conclusão</b><span>{{ (!is_null($nota->usuarioConclusao))?$nota->usuarioConclusao->name:'--' }}</span></li>
            <li><b>Data Conclusão</b><span>{{ (!is_null($nota->data_conclusao))?date('d/m/Y H:i:s', strtotime($nota->data_conclusao)):'--' }}</span></li>
            <li><b>Observações</b><span>---</span></li>
        </ul>
    </div>
    <header class="bg-white p-2 d-flex justify-between">
        <div class="nota-select px-2" id="Nota_{{ $nota->id }}" title="Clique aqui para selecionar essa nota">{{ $nota->nota }}</div>
        <div>{{ date('d/m/Y',strtotime($nota->created_at)) }}</div>
        <div>{{ $nota->carga->os }}</div>
        <div><i class="fa-solid fa-circle-exclamation cursor-pointer info-nota-component" nota={{ $nota->id }}></i></div>
    </header>

    <div>
        <ul class="dados-nota-component">
            <li ><b>Cliente</b><span>{{ $nota->destinatario->nome_razao_social }}</span></li>
            <li ><b>CPF/CNPJ</b><span>{{ $nota->destinatario->cpf_cnpj }}</span></li>
            <li><b>Valor</b><span>R$ {{ number_format($nota->valor,2,',','.') }}</span></li>
            <li><b>Forma Pagamento</b> <span>{{ TipoPagamento::getTipoPagamentoByCodigo($nota->tipo_pagamento) }}</span></li>
            <li><b>Tipo Pagamento</b> <span>{{ IndicacaoPagamento::getIndPagamento($nota->indicacao_pagamento_id) }}</span></li>
        </ul>


    </div>

    <footer class="bg-white p-2 d-flex justify-around">
        <a href="" class="btn btn-outline-success atualiza-nota-component">Atualizar</a> <a href="" class="btn btn-outline-primary">Consultar</a>
    </footer>
</div>
