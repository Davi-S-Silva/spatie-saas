<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Users') }}
        </h2>
    </x-slot>
    <div class="py-1">
        <div class="mx-auto sm:px-1 lg:px-1">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="card col-12">
                    <div class="card-header col-12 m-0 p-0">
                        <h4 class="p-3 m-0 d-flex justify-between align-items-center">
                            Users <a href="{{ route('users.create') }}"
                                class="btn btn-primary m-0">Add User</a></h4>
                    </div>
                    <div class="card-body">
                        <table class="table m-0">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Empresa</th>
                                    <th scope="col">Funcao</th>
                                    <th scope="col">Roles</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $item)
                                    <tr>
                                        <th scope="row">{{ $item->id }}</th>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ (count($item->empresa)!=0)?$item->empresa->first()->nome:'-' }}</td>
                                        <td>{{ (count($item->colaborador)!=0)?$item->colaborador->first()->funcao->funcao:'-' }}</td>
                                        <td>

                                            @if (!empty($item->getRoleNames()))
                                                @foreach ($item->getRoleNames() as $rolename)
                                                <span class="badge bg-primary-subtle border border-primary-subtle text-primary-emphasis rounded-pill">
                                                    @role('tenant-admin-master|tenant-admin')
                                                    {{ str_replace('tenant-','',$rolename) }}
                                                @else
                                                   {{ $rolename }}
                                                @endrole
                                                </span>
                                                @endforeach
                                            @endif

                                        </td>
                                        <td class="d-flex">
                                             {{-- <a href="{{ route('users.give-permission', ['role' => $item->id]) }}" class="btn btn-warning mx-2">Add / Edit Role Permission</a> --}}
                                            @can('Editar Usuario')
                                                <a href="{{ route('users.edit', ['user' => $item->id]) }}" class="btn btn-primary mx-2">Edit</a>
                                            @else
                                                <button disabled class="btn btn-primary mx-2">Edit</button>
                                            @endcan

                                            @can('Deletar Usuario')

                                            <form action="{{ route('users.destroy', ['user' => $item->id]) }}" name="formDeleteUser" method="post"><input type="submit" value="Delete" class="btn btn-danger ">
                                                @csrf
                                                @method("DELETE")
                                            </form>
                                            @else
                                                <button disabled class="btn btn-danger mx-2">Delete</button>
                                            @endcan
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
