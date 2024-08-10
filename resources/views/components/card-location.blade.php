<ul class="col-12 card-location">
    <li class="border-b-2">
        <div class="d-flex align-items-center justify-between">
            <div class="d-flex align-items-center">
                <figure class="bg-icon-card-location mr-2"
                    style="background-image: url({{ asset('img/icon-caminhao.png') }})"></figure>
                <figcaption class="font-bold">{{ $item->placa }}
                    <div>
                    {{ $item->descricao }}
                 </div></figcaption>
            </div>
            <div>

                <span class=" {{ (int) $item->ignicao === 1 ? 'badge bg-success-subtle border border-success-subtle text-success-emphasis' : 'badge bg-primary-subtle border border-primary-subtle text-primary-emphasis' }} rounded-pill">
                    <i class="fa-solid fa-power-off mr-1"></i>{{ (int) $item->ignicao === 1 ? 'Ligado' : 'Desligado' }}
                </span>
            </div>
        </div>
        <div class="d-flex mt-2 mb-3">
            <div class="d-flex align-items-center mr-5">
                <div class="mr-1">
                    <i class="fa-solid fa-gauge text-3xl"></i>
                </div>
                <div class="d-flex flex-column justify-center align-items-center text_items_icons_card_location">
                    <header>Velocidade</header>
                    <div class="font-extrabold">{{ $item->velocidade }} km/h</div>
                </div>
            </div>
            <div class="d-flex align-items-center">
                <div class="mr-1">
                    <i class="fa-solid fa-car-battery text-3xl"></i>
                </div>
                <div class="d-flex flex-column justify-center align-items-center text_items_icons_card_location">
                    <header>Bateria</header>
                    <div class="font-extrabold">{{ (!is_null($item->bateria))?number_format($item->bateria,2,'.',''):'-' }}</div>
                </div>
            </div>
        </div>
    </li>
    <li class="border-b-2">
        <div class="my-3">
            <div>
                <i class="fa-solid fa-location-dot mr-1"></i>
                {{ $item->endereco }}
                <div class="d-flex justify-around">
                    {{-- &ThinSpace; &ThinSpace; &ThinSpace; --}}
                    <small>Latitude: {{ $item->latitude }}</small>
                    <small>Longitude: {{ $item->longitude }}</small>
                </div>
            </div>
            <div>
                &ThinSpace; &ThinSpace; &ThinSpace;
                <small class="text-gray-500">Última Atualização em {{ date('d/m/Y H:i:s', strtotime($item->dataHoraLocalizacao)) }}</small><br>
                &ThinSpace; &ThinSpace; &ThinSpace;
                <small class="text-gray-500">Atualização Local {{ date('d/m/Y H:i:s') }}</small>
            </div>
        </div>
    </li>
    <li class="d-flex justify-around">
        <div class="mt-3">
            <a href="{{ route('getLocalizacaoVeiculo', ['equipamento' => $item->id_equipamento]) }}"
                class="btn btn-primary">Mais Detalhes</a>
                <a href="{{ route('monitorarVeiculo', ['veiculo' => $item->placa]) }}"
                class="btn btn-success">Monitorar</a>
        </div>
    </li>
</ul>
