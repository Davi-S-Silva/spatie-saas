<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Empresas') }}
        </h2>
    </x-slot>
    <div class="py-1">
        <div class="max-w-7xl mx-auto px-1">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="card col-12 p-2">
                    <div>
                        <h1 class="font-bold">{{ $empresa->name }}</h1>
                    </div>

                    <div>
                        <h1 class="font-bold">Endereco</h1>
                        @forelse ($empresa->enderecos as $endereco)
                            {{$endereco->rua}}
                        @empty
                            endereco nao cadastrado
                        @endforelse
                    </div>
                    <div>
                        <h1>Locais de apoio</h1>

                        @forelse ($empresa->localapoio as $apoio)
                            <ul class="px-3 py-1">
                                <li>{{ $apoio->name }}</li>
                            </ul>
                        @empty
                            sem local cadastrado.
                        @endforelse
                        <div>
                            <a href="{{ route('localapoio.create') }}" class="btn btn-primary">Add Local de Apoio</a>
                        </div>
                    </div>
                    <div>
                        <label for="">Certificados</label>
                        @foreach ($empresa->certificate as $certificado)
                            <ul class="px-3 py-1">
                                <li>{{ $certificado->name }}</li>
                            </ul>
                        @endforeach
                    </div>
                    {{-- @foreach ($certificados as $certificado)
                        <ul>
                            <li>{{ $certificado->empresa->name }}</li>
                        </ul>
                    @endforeach --}}
                    <div>
                        <a href="{{ route('empresa.edit', ['empresa' => $empresa->id]) }}"
                            class="btn btn-primary m-2">Editar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
