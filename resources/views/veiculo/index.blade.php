<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Veículos') }}
        </h2>
    </x-slot>
    <div class="py-1">
        <div class="mx-auto px-1">
            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="card col-12 p-2">
                    <div id="ResponseVeiculos"></div>
                    <div>
                        <form action="" name="ColaboradorVeiculo" method="post">
                            <span></span>
                            {{-- <input type="hidden" name="Veiculo"> --}}
                            <x-select-colaborador :funcao=null :required=true />
                            @csrf
                            <input type="submit" value="Salvar" class="btn btn-primary my-2">
                        </form>
                    </div>

                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="card col-12 p-2">
                            <table class=" text-center align-items-center">
                                <thead>
                                    <tr class="border-secondary border">
                                        <th class="p-2">-</th>
                                        <th><input type="checkbox" name="" id=""></th>
                                        <th>Placa</th>
                                        <th>Modelo</th>
                                        <th>Tipo</th>
                                        <th>Final Placa</th>
                                        <th>Ano Exercicio</th>
                                        <th>Tacografo</th>
                                        <th>Motorista</th>
                                        <th>Reboque</th>
                                        <th>Cliente</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $indice = 0;
                                    @endphp
                                    @foreach ($veiculos as $veiculo)
                                        <tr
                                            class="{{ $indice % 2 == 0 ? 'bg-claro' : 'bg-mais-claro' }} tr-items border-secondary border">
                                            <td class="show-detalhe-items p-2 m-1" Item={{ $veiculo->id }}><i
                                                    class="fa-regular fa-square-plus"></i></td>
                                            <td><input type="checkbox" name="" id=""></td>
                                            <td><a
                                                    href="{{ route('veiculo.show', ['veiculo' => $veiculo->id]) }}">{{ $veiculo->placa }}</a>
                                            </td>
                                            <td>{{ $veiculo->marca_modelo }}</td>
                                            <td>{{ $veiculo->tipo->name }}</td>
                                            <td>{{ $veiculo->final_placa }}</td>
                                            <td>{{ $veiculo->ano_exercicio }}</td>
                                            <td class="">-</td>
                                            <td class="cursor-pointer" title="Clique para trocar de motorista">
                                                @can('Associar Colaborador')
                                                    <a href="{{ route('associaColaborador', $veiculo->id) }}"
                                                        id="Veiculo_{{ $veiculo->id }}" class="a_colaborador_veiculo"
                                                        placa={{ $veiculo->placa }}>
                                                        {{ count($veiculo->colaborador) != 0 ? $veiculo->colaborador->first()->name : 'add colaborador' }}</a>
                                                @endcan
                                            </td>
                                            <td class="cursor-pointer" title="Clique para trocar de reboque">
                                                @if ($veiculo->tipo_veiculo_id == 43)
                                                    <a href="{{ route('getSemiReboques') }}" class="get_semireboques"
                                                        veiculo="{{ $veiculo->id }}"
                                                        id="Semireboque_{{ $veiculo->id }}">
                                                        @if ($veiculo->reboque()->count() != 0)
                                                            {{ $veiculo->reboque->first()->placa }}
                                                        @else
                                                            atrelar reboque
                                                        @endif
                                                    </a>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($veiculo->clientes->first())
                                                    {{ $veiculo->clientes->first()->filials()->first()->razao_social }}
                                                @else
                                                    <a
                                                        href="{{ route('mudarVeiculoDeCliente', ['cliente' => 1, 'veiculo' => $veiculo->id]) }}">Alterar
                                                        de cliente</a>
                                                @endif
                                            </td>
                                            @php
                                                $status = $veiculo->getStatus();
                                            @endphp
                                            <td title="{{ $status->descricao }}">{{ $status->name }}</td>
                                        </tr>
                                        @php
                                            $indice++;
                                        @endphp
                                        <tr id="Item_{{ $veiculo->id }}" class="area-show-detalhe">
                                            <td colspan="15" class="bg-slate-200">
                                                <ul class="nav nav-tabs  bg-white" id="myTab_{{ $veiculo->id }}"
                                                    role="tablist">
                                                    <li class="nav-item" role="presentation">
                                                        <button class="nav-link active"
                                                            id="profile-tab_{{ $veiculo->id }}" data-bs-toggle="tab"
                                                            data-bs-target="#profile_{{ $veiculo->id }}"
                                                            type="button" role="tab"
                                                            aria-controls="profile_{{ $veiculo->id }}"
                                                            aria-selected="true">Documentação</button>
                                                    </li>
                                                </ul>
                                                <div class="tab-content" id="myTabContent_{{ $veiculo->id }}">

                                                    <div class="tab-pane fade show active"
                                                        id="profile_{{ $veiculo->id }}" role="tabpanel"
                                                        aria-labelledby="profile-tab_{{ $veiculo->id }}">
                                                    CRLV, Certificado tacografo
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
