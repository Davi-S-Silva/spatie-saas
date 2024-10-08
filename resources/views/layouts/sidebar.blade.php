@php
    use App\Models\Empresa;
    use App\Models\Tenant;
@endphp

<!-- component -->
<!-- This is an example component -->
<div class="max-w-2xl mx-auto aside_menu">
    <aside class="w-64" aria-label="Sidebar">
        <div class="px-3 py-4 bg-white dark:bg-gray-800">
            <ul class="space-y-1">
                <li>
                    <a href="{{ route('dashboard') }}"
                        class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                        <svg class="w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                            fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"></path>
                            <path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"></path>
                        </svg>
                        <span class="ml-3">Dashboard</span>
                    </a>
                </li>
                @can('Listar Empresa')
                    <li>
                        <button type="button"
                            class="flex items-center w-full p-2 text-base font-normal text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700"
                            aria-controls="dropdown-empresa" data-collapse-toggle="dropdown-empresa">
                            <i class="fa-solid fa-building font-extrabold h4 p-1 flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900
                         dark:text-gray-400 dark:group-hover:text-white"
                                style="color: #6b7280;"></i>
                            <span class="flex-1 ml-3 text-left whitespace-nowrap" sidebar-toggle-item>Empresa</span>
                            <svg sidebar-toggle-item class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </button>

                        <ul id="dropdown-empresa" class="hidden py-2 space-y-2">
                            {{-- ESTOQUE --}}

                            <li class="hover_menu position-relative">
                                <a href="{{ route('empresa.index') }}"
                                    class="flex items-center w-full p-2 text-base font-normal text-gray-900 transition duration-75 rounded-lg group
                                     hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 pl-11"><span
                                        class="flex-1 ml-3 text-left whitespace-nowrap"
                                        sidebar-toggle-item>Empresas</span></a>

                                <ul class="position-absolute bg-white w-56">
                                    @foreach (Empresa::All() as $empresa)
                                        <li><a
                                                href="{{ route('empresa.show', ['empresa' => $empresa->id]) }}">{{ $empresa->nome }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>

                            @can('Nova Empresa')
                                <li>
                                    <a href="{{ route('empresa.create') }}"
                                        class="flex items-center w-full p-2 text-base font-normal text-gray-900 transition duration-75 rounded-lg group
                                     hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 pl-11"><span
                                            class="flex-1 ml-3 text-left whitespace-nowrap" sidebar-toggle-item>Nova
                                            Empresa</span></a>
                                </li>
                            @endcan
                            @can('Listar Frete Cliente')
                                <li>
                                    <a href="{{ route('frete.index') }}"
                                        class="flex items-center w-full p-2 text-base font-normal text-gray-900 transition duration-75 rounded-lg group
                                     hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 pl-11"><span
                                            class="flex-1 ml-3 text-left whitespace-nowrap" sidebar-toggle-item>Fretes</span></a>
                                </li>
                            @endcan
                            @can('Visualizar Certificado')
                                <li>
                                    <a href="{{ route('empresa.certificate') }}"
                                        class="flex items-center w-full p-2 text-base font-normal text-gray-900 transition duration-75 rounded-lg group
                                     hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 pl-11"><span
                                            class="flex-1 ml-3 text-left whitespace-nowrap"
                                            sidebar-toggle-item>Certificado</span></a>
                                </li>
                            @endcan
                            @can('Carrega Notas')
                                <li>
                                    <a href="{{ route('empresa.notas') }}"
                                        class="flex items-center w-full p-2 text-base font-normal text-gray-900 transition duration-75 rounded-lg group
                                     hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 pl-11"><span
                                            class="flex-1 ml-3 text-left whitespace-nowrap" sidebar-toggle-item>Notas
                                            Transportes</span></a>
                                </li>
                            @endcan


                            {{-- <li>
                            <a href="#"
                                class="flex items-center w-full p-2 text-base font-normal text-gray-900 transition duration-75 rounded-lg group
                                 hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 pl-11">Invoice</a>
                        </li> --}}
                        </ul>
                    </li>
                @endcan
                @can('Listar Usuario')
                    <li>
                        <button type="button"
                            class="flex items-center w-full p-2 text-base font-normal text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700"
                            aria-controls="dropdown-user" data-collapse-toggle="dropdown-user">
                            <i class="fa-solid fa-user font-extrabold h5 p-1 flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900
                         dark:text-gray-400 dark:group-hover:text-white "
                                style="color: #6b7280;" fill="currentColor"></i>
                            <span class="flex-1 ml-3 text-left whitespace-nowrap" sidebar-toggle-item>Usuario</span>
                            <svg sidebar-toggle-item class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </button>

                        <ul id="dropdown-user" class="hidden py-2 space-y-2">
                            <li><a href="{{ route('users.index') }}"
                                    class="flex items-center w-full p-2 text-base font-normal text-gray-900 transition duration-75 rounded-lg group
                             hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 pl-11">Usuarios</a>
                            </li>
                            @can('Criar Usuario')
                                <li><a href="{{ route('users.create') }}"
                                        class="flex items-center w-full p-2 text-base font-normal text-gray-900 transition duration-75 rounded-lg group
                             hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 pl-11">Novo
                                        Usuario</a></li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('Listar Tenant')
                    <li>
                        <button type="button"
                            class="flex items-center w-full p-2 text-base font-normal text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700"
                            aria-controls="dropdown-tenant" data-collapse-toggle="dropdown-tenant">
                            <i class="fa-solid fa-building font-extrabold h4 p-1 flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900
                         dark:text-gray-400 dark:group-hover:text-white"
                                style="color: #6b7280;"></i>
                            <span class="flex-1 ml-3 text-left whitespace-nowrap" sidebar-toggle-item>Tenant</span>
                            <svg sidebar-toggle-item class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </button>

                        {{-- TENANT --}}
                        <ul id="dropdown-tenant" class="hidden py-2 space-y-2">

                            <li class="hover_menu position-relative">
                                <a href="{{ route('tenant.index') }}"
                                    class="flex items-center w-full p-2 text-base font-normal text-gray-900 transition duration-75 rounded-lg group
                                     hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 pl-11"><span
                                        class="flex-1 ml-3 text-left whitespace-nowrap"
                                        sidebar-toggle-item>Tenants</span></a>

                                <ul class="position-absolute bg-white w-56">
                                    @foreach (Tenant::All() as $tenant)
                                        <li><a
                                                href="{{ route('tenant.show', ['tenant' => $tenant->id]) }}">{{ $tenant->name }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>

                            @can('Criar Tenant')
                                <li>
                                    <a href="{{ route('tenant.create') }}"
                                        class="flex items-center w-full p-2 text-base font-normal text-gray-900 transition duration-75 rounded-lg group
                                     hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 pl-11"><span
                                            class="flex-1 ml-3 text-left whitespace-nowrap" sidebar-toggle-item>Novo
                                            Tenant</span></a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('Listar Colaborador')
                    <li>
                        <button type="button"
                            class="flex items-center w-full p-2 text-base font-normal text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700"
                            aria-controls="dropdown-colaborador" data-collapse-toggle="dropdown-colaborador">
                            <i class="fa-solid fa-people-carry-box font-extrabold h5 p-1 flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900
                          dark:text-gray-400 dark:group-hover:text-white "
                                style="color: #6b7280;" fill="currentColor"></i>
                            <span class="flex-1 ml-3 text-left whitespace-nowrap" sidebar-toggle-item>Colaborador</span>
                            <svg sidebar-toggle-item class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </button>
                        <ul id="dropdown-colaborador" class="hidden py-2 space-y-2">
                            @can('Listar Colaborador')
                                <li><a href="{{ route('colaboradores.index') }}"
                                        class="flex items-center w-full p-2 text-base font-normal text-gray-900 transition duration-75 rounded-lg group
                                hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 pl-11">colaboradores</a>
                                </li>
                            @endcan
                            @can('Criar Colaborador')
                                <li><a href="{{ route('colaboradores.create') }}"
                                        class="flex items-center w-full p-2 text-base font-normal text-gray-900 transition duration-75 rounded-lg group
                                hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 pl-11">Novo
                                        Colaborador</a></li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('Listar Fornecedor')
                    <li>
                        <button type="button"
                            class="flex items-center w-full p-2 text-base font-normal text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700"
                            aria-controls="dropdown-fornecedor" data-collapse-toggle="dropdown-fornecedor">
                            {{-- <i class="fa-solid fa-handshake"></i> --}}
                            <i class="fa-solid fa-handshake font-extrabold h5 p-1 flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900
                          dark:text-gray-400 dark:group-hover:text-white "
                                style="color: #6b7280;" fill="currentColor"></i>
                            <span class="flex-1 ml-3 text-left whitespace-nowrap" sidebar-toggle-item>Fornecedor</span>
                            <svg sidebar-toggle-item class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </button>
                        <ul id="dropdown-fornecedor" class="hidden py-2 space-y-2">
                            @can('Listar Fornecedor')
                                <li><a href="{{ route('fornecedor.index') }}"
                                        class="flex items-center w-full p-2 text-base font-normal text-gray-900 transition duration-75 rounded-lg group
                                hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 pl-11">Fornecedores</a>
                                </li>
                            @endcan
                            @can('Criar Fornecedor')
                                <li><a href="{{ route('fornecedor.create') }}"
                                        class="flex items-center w-full p-2 text-base font-normal text-gray-900 transition duration-75 rounded-lg group
                                hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 pl-11">Novo
                                        Fornecedor</a></li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('Listar Veiculo')
                    <li>
                        <button type="button"
                            class="flex items-center w-full p-2 text-base font-normal text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700"
                            aria-controls="dropdown-veiculo" data-collapse-toggle="dropdown-veiculo">
                            <i class="fa-solid fa-truck-front font-extrabold h5 p-1 flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900
                          dark:text-gray-400 dark:group-hover:text-white "
                                style="color: #6b7280;" fill="currentColor"></i>
                            <span class="flex-1 ml-3 text-left whitespace-nowrap" sidebar-toggle-item>Frota</span>
                            <svg sidebar-toggle-item class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </button>
                        <ul id="dropdown-veiculo" class="hidden py-2 space-y-2">
                            <li class="hover_menu position-relative"><a href="#"
                                    class="flex items-center w-full p-2 text-base font-normal text-gray-900 transition duration-75 rounded-lg group
                                hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 pl-11">Veículo</a>
                                <ul class="position-absolute bg-white w-56">
                                    <li><a href="{{ route('veiculo.index') }}">Veiculos</a></li>
                                    @can('Criar Veiculo')
                                        <li><a href="{{ route('veiculo.create') }}">Novo Veiculo</a></li>
                                        {{-- <li><a href="{{ route('reboque.create') }}">Novo Reboque</a></li> --}}
                                    @endcan
                                </ul>
                            </li>
                            {{-- <li><a href=""
                                class="flex items-center w-full p-2 text-base font-normal text-gray-900 transition duration-75 rounded-lg group
                                hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 pl-11">Novo
                                Veículo</a>
                        </li> --}}
                            {{-- @can('Listar Abastecimento')
                        <li class="hover_menu position-relative"><a href="{{ route('veiculo.create') }}"
                            class="flex items-center w-full p-2 text-base font-normal text-gray-900 transition duration-75 rounded-lg group
                            hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 pl-11">Abastecimento</a>
                            <ul class="position-absolute bg-white w-56">
                                <li><a href="{{ route('abastecimento.index') }}">Abastecimentos</a></li>
                                @can('Criar Abastecimento')
                                    <li><a href="{{ route('abastecimento.create') }}">Novo Abastecimento</a></li>
                                @endcan
                            </ul>
                        </li>
                        @endcan --}}
                            <li class="hover_menu position-relative"><a href="#"
                                    class="flex items-center w-full p-2 text-base font-normal text-gray-900 transition duration-75 rounded-lg group
                                hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 pl-11">Movimentação</a>
                                <ul class="position-absolute bg-white w-56">
                                    <li><a href="{{ route('movimentacao.index') }}">Movimentações</a></li>
                                    <li><a href="{{ route('movimentacao.create') }}">Nova Movimentação</a></li>
                                </ul>
                            </li>
                            <li class="hover_menu position-relative"><a href="#"
                                    class="flex items-center w-full p-2 text-base font-normal text-gray-900 transition duration-75 rounded-lg group
                                hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 pl-11">Monitoramento</a>
                                <ul class="position-absolute bg-white w-56">
                                    <li><a href="{{ route('localizacao.index') }}">Localização</a></li>
                                    <li><a href="{{ route('rastrearTodosVeiculos') }}">Rastreamento</a></li>
                                </ul>
                            </li>
                            <li class="hover_menu position-relative"><a href="#"
                                    class="flex items-center w-full p-2 text-base font-normal text-gray-900 transition duration-75 rounded-lg group
                                hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 pl-11">Manutenção</a>
                                <ul class="position-absolute bg-white w-56">
                                    <li><a href="{{ route('manutencao.index') }}">Manutenções</a></li>
                                    <li><a href="{{ route('manutencao.create') }}">Nova Manutenção</a></li>
                                    <li><a href="{{ route('manutencao.create') }}">Serviços</a></li>
                                </ul>
                            </li>
                            @can('Listar Abastecimento')
                            <li class="hover_menu position-relative"><a href="#"
                                    class="flex items-center w-full p-2 text-base font-normal text-gray-900 transition duration-75 rounded-lg group
                                hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 pl-11">Abastecimento</a>
                                <ul class="position-absolute bg-white w-56">
                                    <li><a href="{{ route('abastecimento.index') }}">Abastecimentos</a></li>
                                    <li><a href="{{ route('abastecimento.create') }}">Novo Abastecimento</a></li>
                                    <li><a href="{{ route('getRanking')}}">Ranking Abastecimento</a></li>
                                </ul>
                            </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                {{-- @can('Listar Abastecimento')
                    <li>
                        <button type="button"
                            class="flex items-center w-full p-2 text-base font-normal text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700"
                            aria-controls="dropdown-abastecimento" data-collapse-toggle="dropdown-abastecimento">
                            <i class="fa-solid fa-gas-pump font-extrabold h5 p-1 flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900
                          dark:text-gray-400 dark:group-hover:text-white "
                                style="color: #6b7280;" fill="currentColor"></i>
                            <span class="flex-1 ml-3 text-left whitespace-nowrap" sidebar-toggle-item>Abastecimento</span>
                            <svg sidebar-toggle-item class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </button>
                        <ul id="dropdown-abastecimento" class="hidden py-2 space-y-2">
                            <li class="hover_menu position-relative"><a href="{{ route('abastecimento.index') }}"
                                    class="flex items-center w-full p-2 text-base font-normal text-gray-900 transition duration-75 rounded-lg group
                            hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 pl-11">Abastecimento</a>
                            </li>
                            @can('Criar Abastecimento')
                                <li class="hover_menu position-relative"><a href="{{ route('abastecimento.create') }}"
                                        class="flex items-center w-full p-2 text-base font-normal text-gray-900 transition duration-75 rounded-lg group
                                    hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 pl-11">Novo
                                        Abastecimento</a></li>
                            @endcan
                            <li class="hover_menu position-relative"><a href="{{ route('getRanking') }}"
                                    class="flex items-center w-full p-2 text-base font-normal text-gray-900 transition duration-75 rounded-lg group
                                    hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 pl-11">Ranking
                                    Abastecimento</a></li>

                        </ul>
                    </li>
                @endcan --}}
                @can('Listar Carga')
                    <li>
                        <button type="button"
                            class="flex items-center w-full p-2 text-base font-normal text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700"
                            aria-controls="dropdown-carga" data-collapse-toggle="dropdown-carga">
                            <i class="fa-solid fa-truck-ramp-box font-extrabold h5 p-1 flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900
                          dark:text-gray-400 dark:group-hover:text-white "
                                style="color: #6b7280;" fill="currentColor"></i>
                            <span class="flex-1 ml-3 text-left whitespace-nowrap" sidebar-toggle-item>Carga</span>
                            <svg sidebar-toggle-item class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </button>
                        <ul id="dropdown-carga" class="hidden py-2 space-y-2">
                            <li><a href="{{ route('carga.index') }}"
                                    class="flex items-center w-full p-2 text-base font-normal text-gray-900 transition duration-75 rounded-lg group
                                hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 pl-11">Cargas</a>
                            </li>
                            {{-- @can('Criar carga') --}}
                            <li><a href="{{ route('carga.create') }}"
                                    class="flex items-center w-full p-2 text-base font-normal text-gray-900 transition duration-75 rounded-lg group
                                hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 pl-11">Nova
                                    Carga</a></li>
                            {{-- @endcan --}}
                        </ul>
                    </li>
                @endcan
                @can('Listar Entrega')
                    <li>
                        <button type="button"
                            class="flex items-center w-full p-2 text-base font-normal text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700"
                            aria-controls="dropdown-entrega" data-collapse-toggle="dropdown-entrega">
                            <i class="fa-solid fa-truck-fast font-extrabold h5 p-1 flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900
                          dark:text-gray-400 dark:group-hover:text-white "
                                style="color: #6b7280;" fill="currentColor"></i>
                            <span class="flex-1 ml-3 text-left whitespace-nowrap" sidebar-toggle-item>Entrega</span>
                            <svg sidebar-toggle-item class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </button>
                        <ul id="dropdown-entrega" class="hidden py-2 space-y-2">
                            <li><a href="{{ route('entrega.index') }}"
                                    class="flex items-center w-full p-2 text-base font-normal text-gray-900 transition duration-75 rounded-lg group
                                hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 pl-11">Entregas</a>
                            </li>
                            {{-- @can('Criar entrega') --}}
                            <li><a href="{{ route('entrega.create') }}"
                                    class="flex items-center w-full p-2 text-base font-normal text-gray-900 transition duration-75 rounded-lg group
                                hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 pl-11">Nova
                                    Entrega</a></li>
                            {{-- @endcan --}}
                        </ul>
                    </li>
                @endcan
                @can('Listar Cliente')
                    <li>
                        <button type="button"
                            class="flex items-center w-full p-2 text-base font-normal text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700"
                            aria-controls="dropdown-cliente" data-collapse-toggle="dropdown-cliente">
                            <i class="fa-solid fa-user-tie font-extrabold h5 p-1 flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900
                          dark:text-gray-400 dark:group-hover:text-white "
                                style="color: #6b7280;" fill="currentColor"></i>
                            <span class="flex-1 ml-3 text-left whitespace-nowrap" sidebar-toggle-item>Cliente</span>
                            <svg sidebar-toggle-item class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </button>
                        <ul id="dropdown-cliente" class="hidden py-2 space-y-2">
                            <li><a href="{{ route('clientes.index') }}"
                                    class="flex items-center w-full p-2 text-base font-normal text-gray-900 transition duration-75 rounded-lg group
                                hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 pl-11">Clientes</a>
                            </li>
                            @can('Criar Cliente')
                                <li><a href="{{ route('clientes.create') }}"
                                        class="flex items-center w-full p-2 text-base font-normal text-gray-900 transition duration-75 rounded-lg group
                                hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 pl-11">Novo
                                        Cliente</a></li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                <li>
                    <button type="button"
                        class="flex items-center w-full p-2 text-base font-normal text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700"
                        aria-controls="dropdown-product" data-collapse-toggle="dropdown-product">
                        <i class="fa-solid fa-boxes font-extrabold h5 p-1 flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900
                          dark:text-gray-400 dark:group-hover:text-white "
                            style="color: #6b7280;" fill="currentColor"></i>
                        <span class="flex-1 ml-3 text-left whitespace-nowrap" sidebar-toggle-item>Estoque</span>
                        <svg sidebar-toggle-item class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </button>
                    <ul id="dropdown-product" class="hidden py-2 space-y-2">
                        <li><a href="{{ route('users.index') }}"
                                class="flex items-center w-full p-2 text-base font-normal text-gray-900 transition duration-75 rounded-lg group
                                hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 pl-11">Produtos</a>
                        </li>
                        @can('Criar Usuario')
                            <li><a href="{{ route('users.create') }}"
                                    class="flex items-center w-full p-2 text-base font-normal text-gray-900 transition duration-75 rounded-lg group
                                hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 pl-11">Novo
                                    Produto</a></li>
                        @endcan
                    </ul>
                </li>

                @can('Listar Fiscal')
                    <li>
                        <button type="button"
                            class="flex items-center w-full p-2 text-base font-normal text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700"
                            aria-controls="dropdown-fiscal" data-collapse-toggle="dropdown-fiscal">
                            {{-- <i class="fa-solid fa-receipt"></i> --}}
                            <i class="fa-solid fa-receipt font-extrabold h5 p-1 flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900
                          dark:text-gray-400 dark:group-hover:text-white "
                                style="color: #6b7280;" fill="currentColor"></i>
                            <span class="flex-1 ml-3 text-left whitespace-nowrap" sidebar-toggle-item>Fiscal</span>
                            <svg sidebar-toggle-item class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </button>
                        <ul id="dropdown-fiscal" class="hidden py-2 space-y-2">
                            @can('Listar CTe')
                            <li class="hover_menu position-relative"><a href="#"
                                class="flex items-center w-full p-2 text-base font-normal text-gray-900 transition duration-75 rounded-lg group
                                hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 pl-11">CTe</a>
                                <ul class="position-absolute bg-white w-56">
                                    <li><a href="{{ route('ctes.index') }}">CTes</a></li>
                                </ul>
                            </li>
                            @endcan
                            @can('Listar MDFe')
                            <li class="hover_menu position-relative"><a href="#"
                                class="flex items-center w-full p-2 text-base font-normal text-gray-900 transition duration-75 rounded-lg group
                                hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 pl-11">MDFe</a>
                                <ul class="position-absolute bg-white w-56">
                                    <li><a href="{{ route('mdfes.index') }}">MDFes</a></li>
                                </ul>
                            </li>
                            @endcan
                            {{-- <li><a href="{{ route('fiscal.index') }}"
                                    class="flex items-center w-full p-2 text-base font-normal text-gray-900 transition duration-75 rounded-lg group
                                hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 pl-11">Fiscals</a>
                            </li> --}}
                            {{-- @can('Criar Fiscal')
                                <li><a href="{{ route('fiscal.create') }}"
                                        class="flex items-center w-full p-2 text-base font-normal text-gray-900 transition duration-75 rounded-lg group
                                hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 pl-11">Novo
                                        CTe</a></li>
                                <li><a href="{{ route('fiscal.create') }}"
                                        class="flex items-center w-full p-2 text-base font-normal text-gray-900 transition duration-75 rounded-lg group
                                hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 pl-11">Novo
                                        MDFe</a></li>
                            @endcan --}}
                        </ul>
                    </li>
                @endcan


                {{-- <li>
                    <a href="#"
                        class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                        <svg class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                            fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z">
                            </path>
                        </svg>
                        <span class="flex-1 ml-3 whitespace-nowrap">Kanban</span>
                        <span class="inline-flex items-center justify-center px-2 ml-3 text-sm font-medium text-gray-800 bg-gray-200 rounded-full dark:bg-gray-700 dark:text-gray-300">Pro</span>
                    </a>
                </li>
                <li>
                    <a href="#"
                        class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                        <svg class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                            fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M8.707 7.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l2-2a1 1 0 00-1.414-1.414L11 7.586V3a1 1 0 10-2 0v4.586l-.293-.293z">
                            </path>
                            <path
                                d="M3 5a2 2 0 012-2h1a1 1 0 010 2H5v7h2l1 2h4l1-2h2V5h-1a1 1 0 110-2h1a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2V5z">
                            </path>
                        </svg>
                        <span class="flex-1 ml-3 whitespace-nowrap">Inbox</span>
                        <span
                            class="inline-flex items-center justify-center w-3 h-3 p-3 ml-3 text-sm font-medium text-blue-600 bg-blue-200 rounded-full dark:bg-blue-900 dark:text-blue-200">3</span>
                    </a>
                </li>
                <li>
                    <a href="#"
                        class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                        <svg class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                            fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <span class="flex-1 ml-3 whitespace-nowrap">Item</span>
                    </a>
                </li>
                <li>
                    <a href="#"
                        class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                        <svg class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                            fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M10 2a4 4 0 00-4 4v1H5a1 1 0 00-.994.89l-1 9A1 1 0 004 18h12a1 1 0 00.994-1.11l-1-9A1 1 0 0015 7h-1V6a4 4 0 00-4-4zm2 5V6a2 2 0 10-4 0v1h4zm-6 3a1 1 0 112 0 1 1 0 01-2 0zm7-1a1 1 0 100 2 1 1 0 000-2z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <span class="flex-1 ml-3 whitespace-nowrap">Products</span>
                    </a>
                </li>
                <li>
                    <a href="#"
                        class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                        <svg class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                            fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M3 3a1 1 0 00-1 1v12a1 1 0 102 0V4a1 1 0 00-1-1zm10.293 9.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L14.586 9H7a1 1 0 100 2h7.586l-1.293 1.293z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <span class="flex-1 ml-3 whitespace-nowrap">Sign In</span>
                    </a>
                </li>
                <li>
                    <a href="#"
                        class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                        <svg class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                            fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M5 4a3 3 0 00-3 3v6a3 3 0 003 3h10a3 3 0 003-3V7a3 3 0 00-3-3H5zm-1 9v-1h5v2H5a1 1 0 01-1-1zm7 1h4a1 1 0 001-1v-1h-5v2zm0-4h5V8h-5v2zM9 8H4v2h5V8z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <span class="flex-1 ml-3 whitespace-nowrap">Sign Up</span>
                    </a>
                </li> --}}
            </ul>
        </div>
    </aside>

    <script src="https://unpkg.com/flowbite@1.3.4/dist/flowbite.js"></script>
</div>
