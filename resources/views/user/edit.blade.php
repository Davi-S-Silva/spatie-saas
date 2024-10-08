<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User Edit') }}
        </h2>
    </x-slot>
    <div class="py-1">
        <div class="mx-auto sm:px-1 lg:px-1">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="card col-12 p-2">
                    <div class="card-header col-12 m-0 p-0">
                        <h4 class="p-3 m-0 d-flex justify-between align-items-center">
                           <span> User <b>{{ $user->name }}</b></span><a href="{{ route('users.index') }}" class="btn btn-primary m-0">Users</a></h4>
                    </div>

                    <div>
                        <label for="">Colaborador Associado</label>
                        @if (count($user->colaborador)!=0)
                            {{ $user->colaborador->first()->name }}
                            <form action="{{ route('colaboradores.update',['colaboradore'=>$user->colaborador->first()->id]) }}" method="POST" enctype="multipart/form-data">
                                @method('PUT')
                                @include('colaborador.form-colaborador',['FuncaoColaborador'=>$FuncaoColaborador,'TipoColaborador'=>$TipoColaborador,'Colaborador'=>$user->colaborador->first()])
                            </form>
                        @else
                            não há usuario atribuido
                        @endif
                    </div>
                    @if ($user->roles->first()->name !=="super-admin" )
                    <div class="card-body">
                        @can('Modificar Role Usuario')



                            <form action="{{ route('users.store-give-role-user', ['user' => $user->id]) }}" method="post" class="col-3">
                                <fieldset>
                                    <legend>User Role Permissons</legend>
                                    @csrf
                                    @method('PUT')
                                        <select name="RolesUser[]" multiple id="" class="form-select form-select-lg mb-3">
                                            @foreach ($roles as $role)
                                            @if ($role->name !== 'super-admin')
                                                @if ($userLogado->roles->first()->id !=1)
                                               {{-- ola {{ $userLogado->roles->first()->id }} --}}
                                                    @if (str_contains($role->name,'tenant'))
                                                        <option value="{{ $role->name }}"
                                                            {{ in_array($role->name, $userRoles) ? 'selected' : '' }}>{{ str_replace('tenant-','',$role->name)}}
                                                        </option>
                                                    @endif
                                                @else
                                                {{-- ola {{ $userLogado->roles->first()->id }} --}}
                                                    <option value="{{ $role->name }}"
                                                        {{ in_array($role->name, $userRoles) ? 'selected' : '' }}>{{ $role->name }}
                                                    </option>
                                                @endif
                                                {{-- {{ in_array($role, $userRoles) ? 'selected' : '' }}>{{ $role }} --}}
                                            @endif
                                        @endforeach
                                    </select>
                                    <input type="submit" value="Atualizar Permissões" class="btn btn-primary">
                                </fieldset>
                            </form>
                        @endcan
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
