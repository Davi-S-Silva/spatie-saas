<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Criar Local Apoio Empresa') }}
        </h2>
    </x-slot>
    <div class="py-1">
        <div class="max-w-7xl mx-auto px-1">
            @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
{{--
@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="card col-12 p-2">
                    @include('empresa.apoio.form-apoio-empresa',['disabled'=>''])
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
