@php
    use App\Models\Veiculo;
@endphp
<div>
    <label for="">Veiculo</label>
    <select name="veiculo" id="" {{ (isset($required))?$required:'' }} class="form-control">
        <option value="">Selecione o veiculo</option>
        @foreach (Veiculo::where('tipo_veiculo_id','<>',40)->get() as $item)
            @if (isset($veiculo) && $veiculo ==$item->id)
            <option value="{{ $item->id }}" selected>{{ $item->placa }}{{ (count($item->reboque)!=0)?'- Semireboque: '.$item->reboque->first()->placa:''  }}</option>
            @else
                <option value="{{ $item->id }}">{{ $item->placa }}  {{ (count($item->reboque)!=0)?'- Semireboque: '.$item->reboque->first()->placa:'' }}</option>
            @endif
        @endforeach
    </select>
</div>
