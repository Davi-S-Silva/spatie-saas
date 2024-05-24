<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Permissions') }}
        </h2>
    </x-slot>
    <div class="py-1">
        <div class="px-1 max-w-8xl mx-auto">
            <div class="bg-white overflow-hidden rounded-lg shadow-sm">

                <div class="card col-12">
                    <div class="card-header col-12 m-0 p-0" >
                        <h4 class="p-3 m-0 d-flex justify-between align-items-center">Permissões <a
                                href="{{ route('permissions.create') }}" class="btn btn-primary m-0">Add Permissões</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <table class="table m-0">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Guard</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($permissions as $item)
                                    <tr>
                                        <th scope="row">{{ $item->id }}</th>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->guard_name }}</td>
                                        <td class="d-flex">
                                            @can('Editar Permissao')
                                                <a href="{{ route('permissions.edit', ['permission' => $item->id]) }}"
                                                    class="btn btn-primary mx-2">Edit</a>
                                            @else
                                                <button disabled class="btn btn-primary mx-2">Edit</button>
                                            @endcan
                                            @can('Deletar Permissao')
                                                <form
                                                    action="{{ route('permissions.destroy', ['permission' => $item->id]) }}"
                                                    name="formDeletePermission" method="post"><input type="submit"
                                                        value="Delete" class="btn btn-danger ">
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
    </div>
</x-app-layout>
