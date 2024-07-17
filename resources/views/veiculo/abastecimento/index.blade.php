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
                                <th>Cupom</th>
                                <th>Km Anterior</th>
                                <th>Km Atual</th>
                                <th>Km Percorrido</th>
                                <th>Litros</th>
                                <th>Valor</th>
                                <th>Veiculo</th>
                                <th>Colaborador</th>
                                <th>Media</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i=0;
                            @endphp
                    @foreach ($Abastecimentos as $abastecimento)
                        <tr class="bg-{{ ($i%2==0)?'claro':'mais-claro' }}">
                            {{-- <td>{{ $abastecimento->id }}</td> --}}
                            @php
                                $kmRodado = ($abastecimento->kmAtual-$abastecimento->kmAnterior);
                            @endphp
                            <td>{{ $abastecimento->cupom }}</td>
                            <td>{{ $abastecimento->kmAnterior }}</td>
                            <td>{{ $abastecimento->kmAtual }}</td>
                            <td>{{ $kmRodado }}</td>
                            <td>{{ number_format($abastecimento->litros,2,',','.') }}</td>
                            <td>R$ {{ number_format($abastecimento->valor,2,',','.') }}</td>
                            <td><a href="{{ route('veiculo.show',['veiculo'=>$abastecimento->veiculo->id]) }}">{{ $abastecimento->veiculo->placa }}</a></td>
                            <td>@if ($abastecimento->colaborador->usuario()->withTrashed()->get()->count()!=0)
                                {{ $abastecimento->colaborador->usuario()->withTrashed()->first()->name }}
                            @else
                                {{ $abastecimento->colaborador->usuario()->first()->name }}
                            @endif</td>
                            @php
                                if($kmRodado==$abastecimento->kmAtual){
                                    $kmRodado=0;
                                }
                            @endphp
                            <td>{{ number_format(($kmRodado/$abastecimento->litros),5,',','.')}}</td>
                        </tr>
                        @php
                            $i++;
                        @endphp
                    @endforeach
                        </tbody>
                    </table>
                    <div class="my-2">
                        {{ $Abastecimentos->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
