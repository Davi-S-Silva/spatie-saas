<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Permission Create') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="card col-12">
                    <div class="card-header col-12 m-0 p-0">
                        <h4 class="p-3 m-0 d-flex justify-between align-items-center">
                            Permissões <a href="{{ route('permissions.index') }}"
                                class="btn btn-primary m-0">Permissões</a></h4>
                    </div>
                    <div class="card-body">
                        {{-- <form name="formAddPermissao" action="{{ route('permissions.store') }}" method="POST"> --}}
                        <form name="formAddPermissao">
                            @csrf
                            <div class="px-3 py-1">
                                <label for="" class="form-label ">Permissão Nome</label>
                                <input type="text" name="PermissionName" id="" class="rounded form-control">
                            </div>
                            <div class="px-3 py-1">
                                <label for="" class="form-label ">Permissão Model</label>
                                <input type="text" name="PermissionModel" id="" class="rounded form-control">
                            </div>
                            <div class="px-3 py-1">
                                <button type="submit" class="btn btn-primary ">Salvar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
