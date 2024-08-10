
@foreach ($dados as $item)
@php
    $obj = (object)$item;
@endphp
<div class="col-3 m-2">
    <x-card-location  :item=$obj />
</div>
@endforeach
