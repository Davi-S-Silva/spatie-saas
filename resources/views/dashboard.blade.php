<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    {{-- @if ($CadastroGeral)
        <div class="modal-info scroll-stop">
            <x-modal-info :veiculos=$veiculos :clientes=$clientes :colaboradores=$colaboradores :fornecedores=$fornecedores/>
        </div>
    @endif --}}

    <div class="py-1">
        <div class="max-w-8xl px-1 mx-auto">
            <div class="bg-white overflow-hidden shadow-sm">
                <div class="p-6 text-gray-900">
                    <header class="flex flex-wrap justify-around">
                        @for ($i = 0; $i < 5; $i++)
                            <div class="col-xl-2 col-md-5 mb-4">
                                <div class="card border-left-primary shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                    Earnings (Monthly)</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">$40,000</div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endfor
                    </header>
<ul>
    <li>Meta de faturamento = 3.000.000,00</li>
    <li>Meta de faturamento = </li>
</ul>

                    {{-- <button class="btn btn-primary" type="button" disabled>
                        <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
                        <span role="status">Loading...</span>
                    </button> --}}
                    {{-- <div class="card col-3 m-2">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text">With supporting text below as a natural lead-in to additional content.
                            </p>
                            <a href="#" class="btn btn-primary">Button</a>
                        </div>
                    </div> --}}
                    {{-- @include('layouts.modal') --}}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
