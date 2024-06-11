@php
    use App\Models\Cliente;
@endphp

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Carga') }}
        </h2>
    </x-slot>
    <div class="py-1">
        <div class="max-w-7xl mx-auto px-1">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="card col-12 p-2">
                    <form action="" method="post" name="FormNovaCarga" enctype="multipart/form-data">
                        <fieldset>
                            <div>
                                <label for="">Cliente</label>

                                @foreach (Cliente::all() as $filials)
                                    @foreach ($filials->filials as $filial)
                                        <div>
                                            <label for="Filial_{{ $filial->id }}">{{ $filial->razao_social }}</label>
                                            <input type="radio" name="Filial" required
                                                id="Filial_{{ $filial->id }}" value="{{ $filial->id }}">
                                        </div>
                                    @endforeach
                                @endforeach
                            </div>

                            <div>
                                <label for="">Remessa</label>
                                <input type="text" name="remessa">
                            </div>
                            <div>
                                <label for="">OS</label>
                                <input type="text" name="os">
                            </div>
                            <div>
                                <label for="">Frete</label>
                                <input type="text" name="frete" id="">
                            </div>
                            <div>
                                <label for="">Data e Hora</label>
                                <input type="datetime-local" name="data" id="">
                            </div>

                            <x-select-localapoio/>

                            <div>
                                <label for="">Notas</label>
                                <textarea name="Notas" id="" cols="30" rows="10"></textarea>
                            </div>
                            @csrf

                            <input type="submit" value="Salvar" class="btn btn-primary">
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
