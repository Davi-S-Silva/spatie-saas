<ul class="col-sm-4 col-12 my-2">
   <li> placa: {{ $item->placa }}</li>
   <li> Data/Hora Ultima localização: {{ date('d/m/Y H:i:s', strtotime($item->dataHoraLocalizacao)) }}</li>
   <li> Data/Hora Atualização: {{ date('d/m/Y H:i:s', strtotime($item->dataUpdate)) }}</li>
   <li> Endereco: {{ $item->endereco }}</li>
   <li>  Ignicao: {{ ((int)$item->ignicao === 1)?'Ligado':'Desligado' }}</li>
   <li>  Velocidade: {{ $item->velocidade }}km/h</li>
   <li class="d-flex justify-around"><a href="{{ route('getLocalizacaoVeiculo',['equipamento'=>$item->id_equipamento]) }}" class="btn btn-primary">Mais Detalhes</a><a href="{{ route('monitorarVeiculo',['veiculo'=>$item->placa]) }}" class="btn btn-success">Monitorar</a></li>

</ul>
