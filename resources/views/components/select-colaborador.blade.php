@php
    use App\Models\Colaborador;
@endphp
<section class="d-flex flex-column">
    <div class="d-flex justify-between px-2">
        @if ($funcao==2)
        <label for="" class="form-label">Ajudante</label>
        @elseif($funcao==1)
        <label for="" class="form-label">Motorista</label>
        @else
        Colaborador
        @endif
        {{-- <a href="#" class="remove_select_colaborador">X</a> --}}
    </div>
    <select name="colaborador" class="colaborador form-control border-black" id="" {{ ($required)?'required':'' }}>
        <option value="">Selecione o Colaborador</option>

        @if (!is_null($funcao))
            @foreach (Colaborador::orderBy('name','asc')->where('funcao_id',$funcao)->get() as $item)
                @if (isset($colaborador) && $colaborador==$item->id)
                    <option value="{{ $item->id }}" selected>{{ $item->name }} - {{ $item->funcao->funcao }} -

                        @role('super-admin')
                        {{ $item->id }} - {{ $item->empresa->nome }}
                        @endrole

                    </option>
                @else
                    <option value="{{ $item->id }}">{{ $item->name }} - {{ $item->funcao->funcao }}

                        @role('super-admin')
                        {{ $item->id }} - {{ $item->empresa->nome }}
                        @endrole
                    </option>
                @endif
            @endforeach
        @else
            @foreach (Colaborador::all() as $item)
                @if (isset($colaborador) && $colaborador==$item->id)
                    <option value="{{ $item->id }}" selected>{{ $item->name }} - {{ $item->funcao->funcao }}
                        @role('super-admin')
                        {{ $item->id }} - {{ $item->empresa->nome }}
                        @endrole
                    </option>
                @else
                    <option value="{{ $item->id }}">{{ $item->name }} - {{ $item->funcao->funcao }}
                        @role('super-admin')
                        {{ $item->id }} - {{ $item->empresa->nome }}
                        @endrole
                    </option>
                @endif
            @endforeach
        @endif


    </select>
</section>
