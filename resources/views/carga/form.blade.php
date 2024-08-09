@php
    use App\Models\Cliente;
@endphp

<fieldset {{ $disabled }}>
    <div>
        <label for="">Cliente</label>

        @foreach ($clientes as $filials)
            @foreach ($filials->filials as $filial)
                <div>
                    <label for="Filial_{{ $filial->id }}">{{ $filial->razao_social }}</label>
                    <input type="radio" name="Filial" required id="Filial_{{ $filial->id }}"
                        value="{{ $filial->id }}" {{ (isset($carga->filial_id) && $carga->filial_id==$filial->id)?'checked':'' }}>
                </div>
            @endforeach
        @endforeach
    </div>
    @if (!empty($disabled))
        <div class="modal-info scroll-stop">
            <x-modal-info :link=$link :text=$text/>
        </div>
    @endif
    <div>
        <label for="">Area Atendimento</label>
        <input type="text" name="area" id="" value="{{ isset($carga->area) ? $carga->area : '' }}">
    </div>
    <div>
        <label for="">Motorista</label>
        @if (isset($carga->motorista_id))
            <x-select-colaborador :colaborador="$carga->motorista->id" :funcao=1 :required=true/>
        @else
            <x-select-colaborador  :funcao=1 :required=true/>
        @endif

    </div>
    <div>
        <label for="">Peso</label>
        <input type="text" name="peso" id="" value="{{ isset($carga->peso) ? $carga->peso : '' }}">
    </div>
    <div>
        <label for="">Entregas</label>
        <input type="text" name="entregas" id=""
            value="{{ isset($carga->entregas) ? $carga->entregas : '' }}">
    </div>
    <div>
        <label for="">Remessa</label>
        <input type="text" name="remessa" value="{{ isset($carga->remessa) ? $carga->remessa : '' }}">
    </div>
    <div>
        <label for="">OS</label>
        <input type="text" name="os" value="{{ isset($carga->os) ? $carga->os : '' }}">
    </div>
    <div>
        <label for="">Frete</label>
        <input type="text" name="frete" id="" value="{{ isset($carga->frete) ? $carga->frete : '' }}">
    </div>
    <div>
        <label for="">Veiculo</label>
        @if (isset($carga->veiculo_id))
            <x-select-veiculo :veiculo="$carga->veiculo_id" />
        @else
            <x-select-veiculo />
        @endif
    </div>
    <div>
        <label for="">Data e Hora</label>
        <input type="datetime-local" name="data" id="" value="{{ isset($carga->data) ? $carga->data : '' }}">
    </div>
    <div>
        <label for="">Agenda</label>
        <input type="date" name="agenda" id="" value="{{ isset($carga->agenda) ? $carga->agenda : '' }}">
    </div>

    @if (isset($carga->local_apoio_id))
        <x-select-localapoio :carga="$carga->local_apoio_id" />
    @else
        <x-select-localapoio />
    @endif

    {{-- <div>
        <label for="">Notas</label>
        <textarea name="Notas" id="" cols="30" rows="10"></textarea>
    </div> --}}
    @csrf

    <input type="submit" value="Salvar" class="btn btn-primary">
</fieldset>
