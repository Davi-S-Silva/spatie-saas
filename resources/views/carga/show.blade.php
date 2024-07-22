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
                    {{ $carga->filial->razao_social }}
                    {{ $carga->localApoio->name }}
                    {{ $carga->getStatus()->descricao }}
                    {{ $carga->veiculo->placa }}
                    {{ count($carga->paradas()) }}
                    @foreach ($carga->cidades() as $cidade)
                        {{ $cidade }}
                    @endforeach
                    <div>
                        <header>Notas</header>
                        <section>
                            @foreach ($carga->notas()->with('destinatario')->orderBy('destinatario_id','asc')->get() as $nota)
                                <x-nota :nota=$nota/>
                            @endforeach
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
