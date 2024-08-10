{{-- @php
    use App\Models\Manutencao;
@endphp --}}

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manutenções') }}
        </h2>
    </x-slot>
    <div class="py-1">
        <div class="mx-auto px-1">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="card col-12 p-2">
                    <table class=" text-center align-items-center">
                        <thead>
                            <tr class="border-secondary border">
                                <th class="p-2">-</th>
                                <th><input type="checkbox" name="" id=""></th>
                                <th>Placa</th>
                                <th>Colaborador</th>
                                <th>Fornecedor</th>
                                <th>Valor</th>
                                <th>Agendamento</th>
                                <th>Inicio</th>
                                <th>Conclusao</th>
                                <th>Autorização</th>
                                <th>Status</th>
                                {{-- <th>Status</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $indice = 0;
                            @endphp
                            @foreach ($manutencoes as $manutencao)
                                <tr
                                    class="{{ $indice % 2 == 0 ? 'bg-claro' : 'bg-mais-claro' }} tr-items border-secondary border">
                                    <td class="show-detalhe-items p-2 m-1" Item={{ $manutencao->id }}><i
                                            class="fa-regular fa-square-plus"></i></td>
                                    <td><input type="checkbox" name="" id=""></td>
                                    <td>{{ $manutencao->veiculo->placa }}</td>
                                    <td>{{ !is_null($manutencao->colaborador) ? $manutencao->colaborador->name : '-' }}
                                    </td>
                                    <td>{{ $manutencao->fornecedor->name }}</td>
                                    <td>{{ $manutencao->valor }}</td>
                                    <td class="">{{ date('d/m/Y H:i', strtotime($manutencao->agendamento)) }}</td>
                                    <td class="">
                                        {{ !is_null($manutencao->data_inicio) ? $manutencao->data_inicio : '-' }}</td>
                                    <td class="">
                                        {{ !is_null($manutencao->data_inicio) ? $manutencao->data_fim : '-' }}</td>
                                    <td>{{ !is_null($manutencao->autorizacao) ? $manutencao->autorizacao->name : '-' }}
                                    </td>
                                    @php
                                        $status = $manutencao->getStatus();
                                    @endphp
                                    <td title="{{ $status->descricao }}">{{ $status->name }}</td>
                                </tr>
                                @php
                                    $indice++;
                                @endphp
                                <tr id="Item_{{ $manutencao->id }}" class="area-show-detalhe">
                                    <td colspan="15" class="bg-slate-200">
                                        <ul class="nav nav-tabs  bg-white" id="myTab_{{ $manutencao->id }}"
                                            role="tablist">
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link active" id="servico-tab_{{ $manutencao->id }}"
                                                    data-bs-toggle="tab"
                                                    data-bs-target="#servico_{{ $manutencao->id }}" type="button"
                                                    role="tab" aria-controls="servico_{{ $manutencao->id }}"
                                                    aria-selected="true">Serviços</button>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link" id="observacao-tab_{{ $manutencao->id }}"
                                                    data-bs-toggle="tab"
                                                    data-bs-target="#observacao_{{ $manutencao->id }}" type="button"
                                                    role="tab" aria-controls="observacao_{{ $manutencao->id }}"
                                                    aria-selected="true">Observações</button>
                                            </li>
                                        </ul>
                                        <div class="tab-content" id="myTabContent_{{ $manutencao->id }}">

                                            <div class="tab-pane fade show active" id="servico_{{ $manutencao->id }}"
                                                role="tabpanel" aria-labelledby="servico-tab_{{ $manutencao->id }}">
                                                <a href="" class="btn btn-primary add_servico_manutencao m-2" manutencao="{{  $manutencao->id }}"><i class="fa-regular fa-square-plus"></i> Add Serviço</a>
                                                <div class="d-flex justify-center">
                                                    <table class="text-center col-6">
                                                        <thead>
                                                            <tr class="border-secondary border">
                                                                <th class="py-2">Serviço</th>
                                                                <th>Descrição</th>
                                                                <th>Preço</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @php
                                                            $i=0;
                                                        @endphp
                                                        @forelse ($manutencao->servicos()->get() as $servicoManutencao)
                                                        <tr class="{{ (($i%2)==0)?'bg-white':'' }} border-secondary border">
                                                            <td class="py-2">{{ $servicoManutencao->servico->name }}</td>
                                                            <td>{{ $servicoManutencao->descricao }}</td>
                                                            <td>{{ $servicoManutencao->valor }}</td>
                                                            {{-- <td></td> --}}
                                                        </tr>
                                                        @php
                                                        $i++;
                                                        @endphp
                                                        @empty
                                                        <tr>Não há Serviços</tr>
                                                        @endforelse
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="observacao_{{ $manutencao->id }}"
                                                role="tabpanel" aria-labelledby="observacao-tab_{{ $manutencao->id }}">
                                                <pre>
                                                    @foreach ($manutencao->observacoes()->get() as $obs)
{{ print_r($obs->getAttributes()) }}
@endforeach
                                                </pre>
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
</x-app-layout>
