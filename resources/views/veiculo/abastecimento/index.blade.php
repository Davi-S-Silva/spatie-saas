<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Abastecimentos') }}
        </h2>
    </x-slot>
    <div class="py-1">
        <div class="mx-auto px-1">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="card col-12 p-2">
                    {{-- <form action="{{ route('abastecimento.store') }}" name="FormAbastecimento" method="post" enctype="multipart/form-data">
                        @include('veiculo.abastecimento.form-abastecimento')
                    </form> --}}

                    <section>
                        <form action="{{ route('postQueryIndexAbastecimento') }}" method="post" class="d-flex align-items-end justify-center mb-5">
                            <div class="col-2 mr-2">
                                <x-select-veiculo />
                            </div>
                            <div class="col-2 mr-2">
                                <x-select-colaborador :funcao=1 :required=false />
                            </div>
                            <div class="d-flex mr-2">
                                <div class=" mr-2">
                                    <label for=""class="form-label">Data Inicio</label>
                                    <input type="date" class="form-control rounded border-black" name="Inicio" id="">
                                </div>
                                <div class=" mr-2">
                                    <label for=""class="form-label">Data Final</label>
                                    <input type="date" class="form-control rounded border-black" name="Fim" id="">
                                </div>
                            </div>
                            <div>
                                @csrf
                                <input type="submit" value="Buscar" class="btn btn-primary">
                                <input type="submit" name="Reset" value="Limpar filtros" class="btn btn-danger">
                            </div>
                        </form>
                    </section>
                    <table class="text-center table-index-abastecimento">
                        <thead>
                            <tr>
                                {{-- <th>Id</th> --}}
                                @php
                                    $array = [
                                        ['name' => 'Data', 'item' => 'created_at'],
                                        ['name' => 'Cupom', 'item' => 'cupom'],
                                        ['name' => 'Km Anterior', 'item' => 'kmAnterior'],
                                        ['name' => 'Km Atual', 'item' => 'kmAtual'],
                                        ['name' => 'Km Percorrido', 'item' => ''],
                                        ['name' => 'Litros', 'item' => 'litros'],
                                        ['name' => 'Valor', 'item' => 'valor'],
                                        ['name' => 'Veiculo', 'item' => 'veiculo_id'],
                                    ];
                                    if(Auth::user()->roles()->first()->name == 'colaborador'){
                                        $array[]=['name' => 'Data', 'item' => 'created_at'];
                                    }else{
                                        $array[]=['name' => 'Colaborador', 'item' => 'colaborador_id'];
                                    }

                                    $array[]=['name' => 'Média', 'item' => ''];

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
                                    <td>{{ date('d/m/Y H:i:s', strtotime($abastecimento->created_at)) }}</td>
                                    @php
                                        $kmRodado = $abastecimento->kmAtual - $abastecimento->kmAnterior;
                                    @endphp
                                    <td class="py-2"> <a href="{{ route('abastecimento.show',['abastecimento'=>$abastecimento->id]) }}">{{ $abastecimento->cupom }}</a></td>
                                    <td>{{ $abastecimento->kmAnterior }}</td>
                                    <td>{{ $abastecimento->kmAtual }}</td>
                                    <td>{{ $kmRodado }}</td>
                                    <td>{{ number_format($abastecimento->litros, 2, ',', '.') }}</td>
                                    <td>R$ {{ number_format($abastecimento->valor, 2, ',', '.') }}</td>
                                    <td><a
                                            href="{{ route('veiculo.show', ['veiculo' => $abastecimento->veiculo->id]) }}">{{ $abastecimento->veiculo->placa }}</a>
                                    </td>
                                    <td>
                                        @if ($abastecimento->colaborador->usuario()->withTrashed()->get()->count() == 0)
                                            @if (Auth::user()->roles()->first()->name == 'colaborador')
                                                {{ date('d/m/Y H:i:s', strtotime($abastecimento->created_at)) }}
                                            @else
                                            {{ $abastecimento->colaborador->usuario()->withTrashed()->first()->name }}
                                            @endif
                                        @else
                                            @if (Auth::user()->roles()->first()->name == 'colaborador')
                                                {{ date('d/m/Y H:i:s', strtotime($abastecimento->created_at)) }}
                                            @else
                                                {{ $abastecimento->colaborador->usuario()->first()->name }}
                                            @endif
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
                    </table> {{-- fim table-index-abastecimento --}}


                    <section class="section-index-abastecimento">
                        <ul class="col-12">
                            @foreach ($Abastecimentos as $abastecimento)
                                <li class="d-flex justify-between mx-1 my-4 card-index-abastecimento col-12">
                                    <ul class="col-6">
                                        <li>Cupom</li>
                                        <li>Km Anterior</li>
                                        <li>Km Atual</li>
                                        <li>Km Percorrido</li>
                                        <li>Litros</li>
                                        <li>Valor</li>
                                        <li>Veículo</li>
                                        <li>Colaborador</li>
                                        <li>Data</li>
                                        <li>Média</li>
                                    </ul>
                                    <ul class="col-6">
                                        <li>{{ $abastecimento->cupom }}</li>
                                        <li>{{ $abastecimento->kmAnterior }}</li>
                                        <li>{{ $abastecimento->kmAtual }}</li>
                                        @php
                                            $kmRodado = $abastecimento->kmAtual - $abastecimento->kmAnterior;
                                        @endphp
                                        <li>{{ $kmRodado }}</li>
                                        <li>{{ $abastecimento->litros }}</li>
                                        <li>{{ $abastecimento->valor }}</li>
                                        <li>{{ $abastecimento->veiculo->placa }}</li>
                                        <li>{{ $abastecimento->colaborador->name }}</li>
                                        <li>{{ date('d/m/Y H:i:s', strtotime($abastecimento->created_at)) }}</li>
                                        <li>{{ number_format($kmRodado / $abastecimento->litros, 5, ',', '.') }}</li>
                                    </ul>
                                </li>
                            @endforeach
                        </ul>
                    </section>

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
                                        ['paginate' => 200],
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
                    </div>{{-- fim paginacao --}}



                </div>
            </div>
        </div>
    </div>
</x-app-layout>
