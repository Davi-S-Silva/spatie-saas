<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Roles Edit') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="card col-12">
                    <div class="card-header col-12 m-0 p-0">
                        <h4 class="p-3 m-0 d-flex justify-between align-items-center">
                            Roles <a href="{{ route('roles.index') }}"
                                class="btn btn-primary m-0">Roles</a></h4>
                    </div>
                    <div class="card-body">
                        {{-- <form name="formEditPermissao"> --}}
                        <form name="formEditRole" action="{{ route('roles.update',['role'=>$role->id]) }}">
                            @method('PUT')
                            @csrf
                            <div class="px-3 py-1">
                                <label for="" class="form-label ">Permissão Nome</label>
                                <input type="text" name="RoleName" id="" value="{{ $role->name }}" class="rounded form-control">
                            </div>
                            <div class="px-3 py-1">
                                <button type="submit" class="btn btn-primary ">Atualizar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
