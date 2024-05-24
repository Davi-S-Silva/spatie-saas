<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Roles') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="card col-12">
                <div class="card-header col-12 m-0 p-0">
                    <h4 class="p-3 m-0 d-flex justify-between align-items-center">Roles <a
                            href="{{ route('roles.create') }}" class="btn btn-primary m-0">Add Roles</a>
                    </h4>
                </div>
                <div class="card-body">
                    <table class="table m-0 ">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Guard</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($roles as $item)
                                <tr class="">
                                    <th scope="row">{{ $item->id }}</th>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->guard_name }}</td>
                                    <td class="d-flex">
                                        @can('Modificar Permissao Regra')
                                            <a href="{{ route('roles.give-permission', ['role' => $item->id]) }}"
                                                class="btn btn-warning mx-2">Add / Edit Role Permission</a>
                                        @else
                                        <button disabled class="btn btn-warning mx-2">Add / Edit Role Permission</button>
                                        @endcan
                                        @can('Editar Regra')
                                            <a href="{{ route('roles.edit', ['role' => $item->id]) }}"
                                                class="btn btn-primary mx-2">Edit</a>
                                        @else
                                        <button disabled class="btn btn-primary mx-2">Edit</button>
                                        @endcan
                                        @can('Deletar Regra')
                                            <form action="{{ route('roles.destroy', ['role' => $item->id]) }}"
                                                name="formDeleteRole" method="post"><input type="submit" value="Delete"
                                                    class="btn btn-danger ">
                                                @csrf
                                                @method('DELETE')
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
</x-app-layout>
