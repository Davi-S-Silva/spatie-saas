@php
    use App\Models\Nota;
    $pagamentos = [
        1,//dinheiro
        3,//credito
        4,//debito
        ];
        $valor = 0;
        $notashidden = '';
        $i=0;
@endphp
<header>
    {{-- {{ $nota->nota }} -
    {{ $nota->destinatario->nome_razao_social }} --}}
     @foreach ($notas as $item)
     @php
        $nota = Nota::find($item);
        $valor += $nota->valor;
        $notashidden.= ($i <count($notas)-1)?$nota->id.'-':$nota->id;
        $i++;
     @endphp
     {{ $nota->nota }}
     @endforeach
</header>
<form action="{{ route('updateStatusNotas') }}" name="UpdateStatusNotas" method="post" enctype="multipart/form-data">
    @method('PUT')
    <fieldset>
        {{-- <div>
            <label for="">Status Nota</label>
            <select name="StatusNota" id="">
                <option value="">Selecione o Status da Nota</option>
                @foreach ($statusNota as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select>
        </div> --}}
        <input type="hidden" name="Notas" value="{{ $notashidden }}">
        @if (in_array($nota->tipo_pagamento_id,$pagamentos) || ($nota->tipo_pagamento_id==15 && $nota->indicacao_pagamento_id==1))
            <div>
                <label for="PagoDiretoEmpresa">Pagamento direto a empresa</label>
                <input type="checkbox" name="PagoDiretoEmpresa" id="PagoDiretoEmpresa">
            </div>
            <div>
                <label for="" class="form-label row">Comprovante</label>
                <input type="file" name="Comprovantes[]" id="Comprovantenota" class="comprovantes_nota col-12" multiple required>
                <div id="CloneComprovante">
                </div>
                <a href="" id="ClonaInputComprovante">Add Comprovante</a>
                <a href="" id="RemoveComprovante"><i class="fa-regular fa-trash-can"></i></a>
            </div>
        @endif
        <div>
            <label for="">Foto Canhotos</label>
            <input type="file" name="FotoCanhotos" id="" class="" multiple>
        </div>
        <div>
            <label for="">Observações</label>
            <textarea name="ObservacaoNota" id="" cols="30" rows="10"></textarea>
        </div>
        @csrf
        <input type="submit" value="Salvar" class="btn btn-primary">
    </fieldset>
</form>
