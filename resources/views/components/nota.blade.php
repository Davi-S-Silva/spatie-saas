@php
    use App\Models\TipoPagamento;
    use App\Models\IndicacaoPagamento;
    $bg_color_nota = '';
    if($nota->status_id == $nota->getStatusId('Entregue')){
        $bg_color_nota = 'bg-notas-success';
    }else if($nota->status_id == $nota->getStatusId('Devolvida')){
        $bg_color_nota = 'bg-notas-danger';
    }else{
        $bg_color_nota = 'bg-notas-light';
    }
@endphp
<input type="checkbox" name="Notas[]"
class="form-check-input d-none text-secondary border-blue-300"
id="Checkbox_Nota_{{ $nota->id }}" value="{{ $nota->id }}">
<div class="col-12 p-2 nota-component d-flex flex-column justify-between position-relative {{ $bg_color_nota }}"  id="Div_Nota_{{ $nota->id }}">
    <div class="position-absolute bg-slate-400 area-info-nota-component" id="Info_Nota_{{ $nota->id }}">
        <div class="text-right p-2 bg-white d-flex justify-between align-items-center border border-black">
            <span class="click_botao_direito position-relative"
            copy="{{ $nota->nota }}"
            title="Clique com o botao direito do mouse para copiar texto"> {{ $nota->nota }}</span>
            <i class="fa-regular fa-rectangle-xmark cursor-pointer close-area-info-nota-component" id="Close_Info_Nota_{{ $nota->id }}" nota={{ $nota->id }}></i>
        </div>
        <ul>
            <li><b>Usuário Conclusão</b><span class="User_Conclusao_Nota_{{ $nota->id }}">{{ (!is_null($nota->usuarioConclusao))?$nota->usuarioConclusao->name:'--' }}</span></li>
            <li><b>Data Conclusão</b><span id="Data_Conclusao_Nota_{{ $nota->id }}">{{ (!is_null($nota->data_conclusao))?date('d/m/Y H:i:s', strtotime($nota->data_conclusao)):'--' }}</span></li>
            <li><b>Observações</b><span id="Obs_Nota_{{ $nota->id }}">
                @php
                $i=0;
                if($nota->observacoes){
                    foreach ($nota->observacoes()->get() as $obs){
                        echo $obs->descricao;
                        if($i<count($nota->observacoes()->get())-1)
                        {
                            echo ', ';
                        }
                        $i++;
                    }
                }else{
                    echo '---';
                }
                @endphp
            </span></li>
        </ul>
    </div>
    <header class="bg-white p-2 d-flex justify-between">
        <div id="Nota_{{ $nota->id }}" title="Clique com o botao esquerdo para selecionar essa nota e com o botao direito do mouse para copiar texto" class="nota-select px-2 click_botao_direito position-relative"
            copy="{{ $nota->nota }}">{{ $nota->nota }}</div>
        <div>{{ date('d/m/Y',strtotime($nota->created_at)) }}</div>
        <div><a href="{{ route('carga.show',['carga'=>$nota->carga->id]) }}">{{ $nota->carga->os }}</a></div>
        <div><i class="fa-solid fa-circle-exclamation cursor-pointer info-nota-component" nota={{ $nota->id }}></i></div>
    </header>

    <div>
        <ul class="dados-nota-component">
            <li ><b>Cliente</b><span>{{ $nota->destinatario->nome_razao_social }}</span></li>
            <li ><b>CPF/CNPJ</b><span class="click_botao_direito position-relative"
                copy="{{ $nota->destinatario->cpf_cnpj }}"
                title="Clique com o botao direito do mouse para copiar texto">{{ $nota->destinatario->cpf_cnpj }}</span></li>
            <li><b>Valor</b><span>R$ {{ number_format($nota->valor,2,',','.') }}</span></li>
            <li><b>Forma Pagamento</b> <span>{{ TipoPagamento::find($nota->tipo_pagamento_id)->descricao }}</span></li>
            <li><b>Tipo Pagamento</b> <span>{{ IndicacaoPagamento::getIndPagamento($nota->indicacao_pagamento_id) }}</span></li>
        </ul>


    </div>

    <footer class="bg-white p-2 d-flex justify-around">
        <a href="{{ route('editStatusNota',['nota'=>$nota->id]) }}" class="btn btn-outline-success atualiza_nota_component">Atualizar</a>
         <a href="{{ route('notas.show',['nota'=>$nota->id]) }}" class="btn btn-outline-primary">Consultar</a>
    </footer>
</div>
