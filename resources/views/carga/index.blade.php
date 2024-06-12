<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Cargas') }}
        </h2>
    </x-slot>
    <div class="py-1">


        <div class="max-w-7xl mx-auto px-1">
            <section class="d-flex justify-center">
                <form action="" class="form_add_notas" method="post">
                    <header><a href="">X</a></header>
                    <div>
                        <legend>Form Add Notas</legend>
                        <textarea name="Notas[]" id="" cols="60" rows="10"></textarea>
                    </div>
                    @csrf
                    <input type="submit" value="Inserir" class="btn btn-primary">
                </form>
            </section>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="card col-12 p-2">
                    @foreach ($cargas as $carga)
                        <ul>
                            <li><b><a href="{{ route('carga.show',['carga'=>$carga->id]) }}">{{ $carga->remessa }}</b></a>
                                <ul>
                                    @forelse ($carga->notas as $nota)
                                       <li>{{ $nota->nota }}</li>
                                    @empty
                                        <li>nenhuma nota cadastrada</li>
                                    @endforelse
                                </ul>
                                <a class="btn btn-primary add-notas-carga" href="{{ route('carga.setNotas',['carga'=>$carga->id]) }}" id="Carga {{$carga->id}}">Add Notas</a>
                            </li>
                        </ul>
                    @endforeach
                </div>
            </div>

        </div>

    </div>
</x-app-layout>
