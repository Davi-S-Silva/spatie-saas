<section class="area_result_search">
    @if (isset($Notas) && $Notas->count()!=0)
    <header>Notas Encontradas</header>
    <ul>
        @foreach ($Notas as $item)
         <li><a href="{{ route('notas.show',['nota'=>$item->id]) }}">{{ $item->nota }}</a></li>
        @endforeach
    </ul>
    @endif
    @if (isset($Cargas) && $Cargas->count()!=0)
    <header>Cargas Encontradas</header>
    <ul>
        @foreach ($Cargas as $item)
         <li><a href="{{ route('carga.show',['carga'=>$item->id]) }}">Remessa: {{ $item->remessa }} - OS: {{ $item->os }}</a></li>
        @endforeach
    </ul>
    @endif
    @if (isset($Veiculos) && $Veiculos->count()!=0)
    <header>Veiculos Encontradas</header>
    <ul>
        @foreach ($Veiculos as $item)
         <li>{{ $item->placa }}</li>
        @endforeach
    </ul>
    @endif
    @if (isset($Colaboradores) && $Colaboradores->count()!=0)
    <header>Colaboradores Encontrados</header>
    <ul>
        @foreach ($Colaboradores as $item)
         <li>{{ $item->name }}</li>
        @endforeach
    </ul>
    @endif
</section>
