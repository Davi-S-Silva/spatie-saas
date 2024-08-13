<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Localização') }}
        </h2>
    </x-slot>
    <div class="py-1">
        <div class="mx-auto px-1">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="card col-12 p-2">
                    {{-- <pre> --}}
                    {{ count($locations) }} veículos
                    <section class="d-flex flex-wrap justify-around col-12">
                        <div id="mapAll"></div>
                        @foreach ($locations as $item)
                            {{-- {{ print_r($item) }} --}}
                            <div class="col-3 m-2">
                                <x-card-location :item=$item />
                            </div>
                        @endforeach
                    </section>
                    {{-- </pre> --}}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<script>
    $(document).ready(function() {
        var base = 'http://localhost:8080/' ;
        $.ajax({
            type: 'get',
            url: '/localizacao/monitorar/veiculos/realtime/maps/index',
            success: function(response) {
                var map = L.map('mapAll').setView([response.dados[0].latitude, response.dados[0].longitude], 17);
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
                    minZoom:8,
                    maxZoom: 19
                }).addTo(map);

                $(response.dados).each(function(i, e) {
                    var markerGroup = L.featureGroup([]).addTo(map);
                    var latLng = L.latLng([e.latitude, e.longitude]);
                    var LeafIcon = L.Icon.extend({
                        options: {
                            // shadowUrl: base+'img/OGD9J14.png',
                            // shadowUrl: 'C:/xampp_bkp/htdocs/spatie-saas/public/img/OGD9J14.png',
                            iconSize:     [100, 70],
                            shadowSize:   [50, 64],
                            iconAnchor:   [0,0],
                            shadowAnchor: [4, 62],
                            popupAnchor:  [0, 0]
                        }
                    });
                    // var greenIcon = new LeafIcon({iconUrl: base+'img/'+e.placa+'.png'});
                    var greenIcon = new LeafIcon({iconUrl: base+'img/OGD9J14.png'});
                    L.marker(latLng,{icon:greenIcon}).addTo(map).bindPopup('Placa: ' + e.placa +
                    // L.marker(latLng).addTo(map).bindPopup('Placa: ' + e.placa +
                        '<br>Endreço: ' + e.endereco+'Atualização local: '+e.updateLocal)

                        // .openPopup().addTo(map)

                        // .addTo(markerGroup).addTo(map);
                })
            },
            error: function(response) {
                console.log(response)
            }
        })
    })
</script>
