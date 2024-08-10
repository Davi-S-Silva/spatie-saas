@foreach ($dados as $item)
@php
    $obj = (object)$item;
@endphp
    <x-card-location  :item=$obj />
    {{-- {{ print_r((object)$item) }} --}}
@endforeach
