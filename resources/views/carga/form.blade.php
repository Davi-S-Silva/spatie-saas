@php
    use App\Models\Cliente;
@endphp

<fieldset>
    <div class="form-group col-12 d-flex justify-around area_cliente_carga flex-column border rounded my-2">
        <label for="" class="col-12">Selecione o Cliente</label>

        <div class="col-12 my-3 d-flex justify-around">
            @foreach ($clientes as $filials)
                @foreach ($filials->filials as $filial)
                    <div>
                        <label for="Filial_{{ $filial->id }}">{{ $filial->razao_social }}</label>
                        <input type="radio" name="Filial" required id="Filial_{{ $filial->id }}"
                            value="{{ $filial->id }}"
                            {{ isset($carga->filial_id) && $carga->filial_id == $filial->id ? 'checked' : '' }}>
                    </div>
                @endforeach
            @endforeach
        </div>
    </div>
    {{-- @if (!empty($disabled))
        <div class="modal-info scroll-stop">
            <x-modal-info :link=$link :text=$text/>
        </div>
    @endif --}}
    <div class="col-12 d-flex justify-around">

        <div class="col-sm-4 col-12">
            <label for="" class="form-label">Area Atendimento/Destino</label>
            <input type="text" name="area" id="" class="form-control rounded border-black"
                value="{{ isset($carga->destino) ? $carga->destino : '' }}">
        </div>
        <div class="col-sm-4 col-12">
            {{-- <label for="">Motorista</label> --}}
            @if (isset($carga->motorista_id))
                <x-select-colaborador :colaborador="$carga->motorista->id" :funcao=1 :required=true />
            @else
                <x-select-colaborador :funcao=1 :required=true />
            @endif

        </div>
    </div>
    <div class="col-12 d-flex justify-around">
        {{-- <div class="col-sm-2 col-12">
            <label for="" class="form-label">Peso</label>
            <input type="text" name="peso" id="" class="form-control rounded border-black"
                value="{{ isset($carga->peso) ? $carga->peso : '' }}">
        </div>
        <div class="col-sm-2 col-12">
            <label for="" class="form-label">Entregas</label>
            <input type="text" name="entregas" id="" class="form-control rounded border-black"
                value="{{ isset($carga->entregas) ? $carga->entregas : '' }}">
        </div> --}}
        <div class="col-sm-2 col-12">
            <label for="" class="form-label">Remessa</label>
            <input type="text" name="remessa" class="form-control rounded border-black"
                value="{{ isset($carga->remessa) ? $carga->remessa : '' }}">
        </div>
        <div class="col-sm-2 col-12">
            <label for="" class="form-label">OS</label>
            <input type="text" name="os" class="form-control rounded border-black"
                value="{{ isset($carga->os) ? $carga->os : '' }}">
        </div>
        <div class="col-sm-2 col-12">
            <label for="" class="form-label">Frete</label>
            <input type="text" name="frete" id="" class="form-control rounded border-black"
                value="{{ isset($carga->frete) ? $carga->frete : '' }}">
        </div>
    </div>

    <div class="col-12 d-flex justify-center">
        <div class="col-sm-2 col-6 mx-5">
            <label for="" class="form-label">Data Emissão</label>
            <input type="date" name="data" id="" class="form-control rounded border-black"
                value="{{ isset($carga->data) ? $carga->data : '' }}">
        </div>
        <div class="col-sm-2 col-6 mx-5">
            <label for="" class="form-label">Data Agenda</label>
            <input type="date" name="agenda" id="" class="form-control rounded border-black"
                value="{{ isset($carga->agenda) ? $carga->agenda : '' }}">
        </div>
    </div>
    <div class="d-flex col-12 justify-around">
        <div class="col-sm-2 col-12">
            @if (isset($carga->veiculo_id))
                <x-select-veiculo :veiculo="$carga->veiculo_id" />
            @else
                <x-select-veiculo />
            @endif
        </div>
        @if (isset($carga->local_apoio_id))
            <x-select-localapoio :carga="$carga->local_apoio_id" />
        @else
            <x-select-localapoio />
        @endif
    </div>
    {{-- <div>
        <label for="">Notas</label>
        <textarea name="Notas" id="" cols="30" rows="10"></textarea>
    </div> --}}
    @csrf

    <input type="submit" value="Salvar" class="btn btn-primary my-2">
    <div class="local_include_ajax_response_carga">
    </div>
</fieldset>
