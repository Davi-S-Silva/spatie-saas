<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Modelo de Frete 1') }}
        </h2>
    </x-slot>
    <div class="py-1">
        <div class="mx-auto px-1">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="card col-12 p-2">
                    <div class="mb-5">
                        <header>Frete Nova Área</header>
                        <form action="{{ route('modelo-um-frete.store') }}" method="post" name="FormNovaAreaModeloFreteUm"
                            class="form_frete_modelo_um col-12">
                            <ul class="col-12">
                                <li>
                                    <label for="" class="form-label">Clidade</label>
                                    <textarea name="Cidades" id="" cols="50" rows="5"></textarea>
                                </li>
                                <li>
                                    <label for="" class="form-label">1 Entrega</label>
                                    <input type="text" name="ValorUm">
                                </li>
                                <li>
                                    <label for="" class="form-label">2/3 Entregas</label>
                                    <input type="text" name="ValorDois">
                                </li>
                                <li>
                                    <label for="" class="form-label">4/5 Entregas</label>
                                    <input type="text" name="ValorTres">
                                </li>
                                <li>
                                    <label for="" class="form-label">6/7 Entregas</label>
                                    <input type="text" name="ValorQuatro">
                                </li>
                                <li>
                                    <label for="" class="form-label">8/10 Entregas</label>
                                    <input type="text" name="ValorCinco">
                                </li>
                                <li>
                                    <label for="" class="form-label">11/13 Entregas</label>
                                    <input type="text" name="ValorSeis">
                                </li>
                                <li>
                                    <label for="" class="form-label">14/16 Entregas</label>
                                    <input type="text" name="ValorSete">
                                </li>
                                <li>
                                    <label for="" class="form-label">17/19 Entregas</label>
                                    <input type="text" name="ValorOito">
                                </li>
                                <li>
                                    <label for="" class="form-label">20/23 Entregas</label>
                                    <input type="text" name="ValorNove">
                                </li>
                                <li>
                                    <label for="" class="form-label">24/25 Entregas</label>
                                    <input type="text" name="ValorDez">
                                </li>
                            </ul>
                            <div>
                                @csrf
                                <input type="submit" value="Add Frete" class="btn btn-primary">
                            </div>
                        </form>
                    </div>
                    <hr>
                    <div>
                        <header>Atualizar Frete Áreas</header>
                        @foreach ($fretes as $item)
                            <form action="{{ route('modelo-um-frete.update', ['modelo_um_frete' => $item->id]) }}"
                                method="post" name="ModeloFreteUm"
                                {{-- method="post" name="ModeloFreteUm{{ $item->area }}" --}}
                                class="form_frete_modelo_um col-12">
                                @method('PUT')
                                <ul class="col-12">
                                    <li>
                                        <label for="" class="form-label">Clidade</label>
                                        <textarea name="Cidades" id="" cols="50" rows="5">{{ $item->cidades }}</textarea>
                                    </li>
                                    <li>
                                        <label for="" class="form-label">1 Entrega</label>
                                        <input type="text" name="ValorUm"
                                            value="{{ number_format($item->um, 2, ',', '.') }}">
                                    </li>
                                    <li>
                                        <label for="" class="form-label">2/3 Entregas</label>
                                        <input type="text" name="ValorDois"
                                            value="{{ number_format($item->dois, 2, ',', '.') }}">
                                    </li>
                                    <li>
                                        <label for="" class="form-label">4/5 Entregas</label>
                                        <input type="text" name="ValorTres"
                                            value="{{ number_format($item->tres, 2, ',', '.') }}">
                                    </li>
                                    <li>
                                        <label for="" class="form-label">6/7 Entregas</label>
                                        <input type="text" name="ValorQuatro"
                                            value="{{ number_format($item->quatro, 2, ',', '.') }}">
                                    </li>
                                    <li>
                                        <label for="" class="form-label">8/10 Entregas</label>
                                        <input type="text" name="ValorCinco"
                                            value="{{ number_format($item->cinco, 2, ',', '.') }}">
                                    </li>
                                    <li>
                                        <label for="" class="form-label">11/13 Entregas</label>
                                        <input type="text" name="ValorSeis"
                                            value="{{ number_format($item->seis, 2, ',', '.') }}">
                                    </li>
                                    <li>
                                        <label for="" class="form-label">14/16 Entregas</label>
                                        <input type="text" name="ValorSete"
                                            value="{{ number_format($item->sete, 2, ',', '.') }}">
                                    </li>
                                    <li>
                                        <label for="" class="form-label">17/19 Entregas</label>
                                        <input type="text" name="ValorOito"
                                            value="{{ number_format($item->oito, 2, ',', '.') }}">
                                    </li>
                                    <li>
                                        <label for="" class="form-label">20/23 Entregas</label>
                                        <input type="text" name="ValorNove"
                                            value="{{ number_format($item->nove, 2, ',', '.') }}">
                                    </li>
                                    <li>
                                        <label for="" class="form-label">24/25 Entregas</label>
                                        <input type="text" name="ValorDez"
                                            value="{{ number_format($item->dez, 2, ',', '.') }}">
                                    </li>
                                </ul>
                                <div>
                                    @csrf
                                    <input type="submit" value="Atualizar Frete" class="btn btn-primary"  area="{{ $item->area }}">
                                    <a href="" class="btn btn-danger">Delete Frete Área</a>
                                </div>
                            </form>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
