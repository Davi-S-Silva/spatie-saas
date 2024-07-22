<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Abastecimentos') }}
        </h2>
    </x-slot>
    <div class="py-1">
        <div class="max-w-7xl mx-auto px-1">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="card col-12 p-2">
                    {{-- <form action="{{ route('abastecimento.store') }}" name="FormAbastecimento" method="post" enctype="multipart/form-data">
                        @include('veiculo.abastecimento.form-abastecimento')
                    </form> --}}

                    <table class="text-center">
                        <thead>
                            <tr>
                                {{-- <th>Id</th> --}}
                                @php
                                    $array = [
                                        ['name' => 'Cupom', 'item' => 'cupom'],
                                        ['name' => 'Km Anterior', 'item' => 'kmAnterior'],
                                        ['name' => 'Km Atual', 'item' => 'kmAtual'],
                                        ['name' => 'Km Percorrido', 'item' => ''],
                                        ['name' => 'Litros', 'item' => 'litros'],
                                        ['name' => 'Valor', 'item' => 'valor'],
                                        ['name' => 'Veiculo', 'item' => 'veiculo_id'],
                                        ['name' => 'Colaborador', 'item' => 'colaborador_id'],
                                        ['name' => 'Média', 'item' => ''],
                                    ];
                                @endphp
                                @foreach ($array as $item)
                                    <th>
                                        @if (session()->has('order-by-items-item') && session('order-by-items-item')==$item['item'] && session()->has('order-by-items-order') && session('order-by-items-order')=='asc')
                                            <a href="?item={{ $item['item'] }}&order=asc" class="order-by-items"><i class="fa-solid fa-arrow-up-wide-short text-info"></i></a>
                                        @else
                                            <a href="?item={{ $item['item'] }}&order=asc" class="order-by-items"><i class="fa-solid fa-arrow-up-wide-short"></i></a>
                                        @endif

                                        {{ $item['name'] }}
                                        @if (session()->has('order-by-items-item') && session('order-by-items-item')==$item['item'] && session()->has('order-by-items-order') && session('order-by-items-order')=='desc')
                                            <a href="?item={{ $item['item'] }}&order=desc" class="order-by-items"><i class="fa-solid fa-arrow-down-wide-short text-info"></i></a>
                                        @else
                                            <a href="?item={{ $item['item'] }}&order=desc" class="order-by-items"><i class="fa-solid fa-arrow-down-wide-short"></i></a>
                                        @endif
                                    </th>
                                @endforeach


                                {{-- <th><a href="?item=cupom&order=asc" class="order-by-items"><i class="fa-solid fa-arrow-up-wide-short"></i></a> Cupom <a href="?item=cupom&order=desc" class="order-by-items"><i class="fa-solid fa-arrow-down-wide-short"></i></a></th>
                                <th>Km Anterior</th>
                                <th>Km Atual</th>
                                <th>Km Percorrido</th>
                                <th>Litros</th>
                                <th>Valor</th>
                                <th>Veiculo</th>
                                <th>Colaborador</th>
                                <th>Media</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 0;
                            @endphp
                            @foreach ($Abastecimentos as $abastecimento)
                                <tr class="bg-{{ $i % 2 == 0 ? 'claro' : 'mais-claro' }}">
                                    {{-- <td>{{ $abastecimento->id }}</td> --}}
                                    @php
                                        $kmRodado = $abastecimento->kmAtual - $abastecimento->kmAnterior;
                                    @endphp
                                    <td>{{ $abastecimento->cupom }}</td>
                                    <td>{{ $abastecimento->kmAnterior }}</td>
                                    <td>{{ $abastecimento->kmAtual }}</td>
                                    <td>{{ $kmRodado }}</td>
                                    <td>{{ number_format($abastecimento->litros, 2, ',', '.') }}</td>
                                    <td>R$ {{ number_format($abastecimento->valor, 2, ',', '.') }}</td>
                                    <td><a
                                            href="{{ route('veiculo.show', ['veiculo' => $abastecimento->veiculo->id]) }}">{{ $abastecimento->veiculo->placa }}</a>
                                    </td>
                                    <td>
                                        @if ($abastecimento->colaborador->usuario()->withTrashed()->get()->count() != 0)
                                            {{ $abastecimento->colaborador->usuario()->withTrashed()->first()->name }}
                                        @else
                                            {{ $abastecimento->colaborador->usuario()->first()->name }}
                                        @endif
                                    </td>
                                    @php
                                        if ($kmRodado == $abastecimento->kmAtual) {
                                            $kmRodado = 0;
                                        }
                                    @endphp
                                    <td>{{ number_format($kmRodado / $abastecimento->litros, 5, ',', '.') }}</td>
                                </tr>
                                @php
                                    $i++;
                                @endphp
                            @endforeach
                        </tbody>
                    </table>
                    <div class="my-2">
                        <div class="col-12 text-center">
                            <b>Paginação</b>
                            <div class="col-12 d-flex justify-center">
                                @php
                                    $arrayPaginate = [
                                        ['paginate' => 1],
                                        ['paginate' => 2],
                                        ['paginate' => 4],
                                        ['paginate' => 5],
                                        ['paginate' => 10],
                                        ['paginate' => 20],
                                        ['paginate' => 30],
                                        ['paginate' => 50],
                                        ['paginate' => 100],
                                    ];
                                @endphp
                                @foreach ($arrayPaginate as $item)
                                    @if (session()->has('paginate-by-page') && session('paginate-by-page') == $item['paginate'])
                                        <a href="?paginate={{ $item['paginate'] }}"
                                            id="Paginate_{{ $item['paginate'] }}"
                                            class="mx-2 paginate-by-page paginate-by-page-color">{{ $item['paginate'] }}</a>
                                    @else
                                        <a href="?paginate={{ $item['paginate'] }}"
                                            id="Paginate_{{ $item['paginate'] }}"
                                            class="mx-2 paginate-by-page">{{ $item['paginate'] }}</a>
                                    @endif
                                @endforeach

                            </div>
                        </div>
                        {{ $Abastecimentos->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
