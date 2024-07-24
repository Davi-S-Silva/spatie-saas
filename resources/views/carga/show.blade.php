@php
    use App\Models\DistanceCity;
@endphp
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Show Carga') }}
        </h2>
    </x-slot>
    <div class="py-1">
        <div class="max-w-7xl mx-auto px-1">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="card col-12 p-2">
                    {{-- <form action="{{ route('carga.update',['carga'=>$carga->id]) }}" method="post" name="EditCarga" enctype="multipart/form-data">
                        @method('put')
                        @include('carga.form',['carga'=>$carga])
                    </form> --}}
                    {{-- <pre>
                        {{ print_r($carga->getAttributes()) }}
                    </pre> --}}
                    <ul>
                        <li>{{ $carga->filial->razao_social }}</li>
                        <li>{{ $carga->localApoio->name }}</li>
                        <li>{{ $carga->getStatus()->descricao }}</li>
                        <li>{{ $carga->veiculo->placa }}</li>
                        <li>{{ $carga->frete }}</li>
                        <li>{{ $carga->destino }}</li>
                        <li>{{ count($carga->paradas()) }}</li>
                        <li>Peso: <b>{{ number_format($carga->peso(),2,',','.') }}</b></li>
                        <li>Valor: <b>{{ number_format($carga->valor(),2,',','.') }}</b></li>
                    </ul>
                    Cidades:
                    <ul class="d-flex">
                    @foreach ($carga->cidades() as $cidade)
                        <li class="mr-4"> {{ $cidade->nome }}</li>
                    @endforeach
                    </ul>
                    @if (is_null($carga->frete) || $carga->frete ==0)
                        <div class="col-5 d-flex justify-between align-items-center">
                            <a href="{{ route('carga.cidadeFrete',['carga'=>$carga->id]) }}" class="btn btn-primary cidade_frete m-5">Consultar Frete</a>
                            <div id="FreteCity" class="">
                                <ul class="text-center">
                                    <li>Cidade: <span id="CidadeFrete"></span></li>
                                    <li>Frete: <span id="ValorFrete"></span></li>
                                </ul>
                            </div>
                        </div>
                    @endif
                    <div>
                        <header>Notas</header>
                        <section class="d-flex flex-wrap justify-around">
                            @foreach ($carga->notas()->with('destinatario','carga')->orderBy('destinatario_id','asc')->get() as $nota)
                                <x-nota :nota=$nota/>
                            @endforeach
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
