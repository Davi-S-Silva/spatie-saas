<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Carregar Notas de Transportes') }}
        </h2>
    </x-slot>
    <div class="py-1">
        <div class="max-w-7xl mx-auto px-1">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="card col-12 p-2">
                    <form action="{{ route('empresa.notas') }}" name="FormCarregaNotas" method="post"
                        enctype="multipart/form-data">
                        <fieldset>
                            <div>
                                <label for="">Carregar notas</label>
                                <input type="file" required name="notas[]" id="" multiple />
                            </div>
                            {{-- <div>
                                <x-select-empresa />
                            </div> --}}
                            @csrf
                            <input type="submit" value="Carregar Notas" class="btn btn-primary">
                        </fieldset>
                    </form>
                </div>
                <div class="card col-12 p-2">
                    Todas as notas Carregadas {{ count($notas) }}
                    <ul class="col-12">
                        <form action="{{ route('empresa.deletaTodasNotaCarregada') }}" name="FormExcluirNotas" method="post">
                            <div class="bg-slate-400 p-2"> <input type="submit" value="Apagar Todas" class="btn btn-danger"></div>
                            <div>
                                <input type="checkbox" name="SelectAll" id="SelectAll">
                                <label for="SelectAll">Selecionar Todas</label>
                            </div>
                            @csrf
                            @forelse ($notas as $nota)
                                @if ($nota != '.' && $nota != '..')
                                    {{-- <li>{{ $nota }} <a href="{{ $nota }}" class="exclui_nota"><i class="fa-regular fa-trash-can"></i></a></li> --}}
                                    <li class="d-flex justify-around mb-3" id="nota{{ str_replace(' ','_',$nota) }}">
                                        <div>
                                            <input type="checkbox" name="Notas[]" value="{{ $nota }}" id="" class="mr-2">{{ $nota }}
                                            </div>
                                        {{-- <input type="hidden" name="nota" value="{{ $nota }}">  --}}
                                        {{-- <input type="submit" value="Excluir" class="exclui_nota" name="btn_{{ $nota }}"> --}}
                                        <a href="{{ $nota }}" class="exclui_nota"><i
                                                class="fa-regular fa-trash-can"></i></a>
                                    </li>
                                @endif
                            @empty
                                <li>não há notas disponiveis</li>
                            @endforelse
                        </form>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
