<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Roles Add/Edit Permissions') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="card col-12">
                    <div class="card-header col-12 m-0 p-0">
                        <h4 class="p-3 m-0 d-flex justify-between align-items-center">
                            Role {{ $role->name }} <a href="{{ route('roles.index') }}"
                                class="btn btn-primary m-0">Roles</a></h4>
                    </div>
                    <div class="card-body">
                        {{-- <form name="formEditPermissao"> --}}
                        <form name="formGivePermissionRole"
                            action="{{ route('roles.store-give-permission', ['role' => $role->id]) }}" method="POST">
                            @method('PUT')
                            @csrf
                            @php
                                $perm = [];
                            @endphp
                            @foreach ($permissions as $permission)
                                @php
                                    $perm[$permission->model][] = $permission;
                                @endphp
                            @endforeach
                            <div class="px-3 py-1">
                                {{-- <label for="" class="form-label ">Permissão</label> --}}
                                <div class="row">
                                    <div class="col">
                                        <div class="">

                                            @foreach ($perm as $item => $permission)
                                                <div class="">
                                                    <h1 class="h5 font-extrabold">{{ $item }}</h1>
                                                    <div class="">
                                                        @foreach ($perm[$item] as $dados)
                                                            <label class="m-0"
                                                                for="Permission_{{ $dados->name }}">{{ $dados->name }}</label>
                                                            {{-- {{ $dados->name }} --}}
                                                            <input type="checkbox" name="permission[]" multiple
                                                                id="Permission_{{ $dados->name }}"
                                                                value="{{ $dados->name }}"
                                                                {{ in_array($dados->id, $rolePermission) ? 'checked' : '' }}
                                                                class="mr-5"/>

                                                                {{-- <div class="flex items-center space-x-3 cursor-pointer mr-10 ml-2" x-data="{ show: {{ in_array($dados->id, $rolePermission) ? 'true' : 'false' }} }"
                                                                     @click="show =!show">
                                                                    <div class="relative w-10 h-5 transition duration-200 ease-linear rounded-full"
                                                                        :class="[show ? 'bg-indigo-500' : 'bg-gray-300']">
                                                                        <label for="show"
                                                                            @click="show =!show"
                                                                            class="absolute left-0 w-5 h-5 mb-2 transition duration-100 ease-linear transform bg-white border-2 rounded-full cursor-pointer"
                                                                            :class="[show ? 'translate-x-full border-indigo-500' : 'translate-x-0 border-gray-300']"></label>
                                                                        <input type="checkbox" name="permission[]"
                                                                        multiple
                                                                        id="Permission_{{ $dados->name }}"
                                                                        value="{{ $dados->name }}"
                                                                        class="hidden w-full h-full rounded-full appearance-none active:outline-none focus:outline-none"
                                                                        {{ in_array($dados->id, $rolePermission) ? 'checked' : '' }}
                                                                        />
                                                                    </div> --}}

                                                                    {{-- <p class="text-gray-500">Can edit task</p> --}}
                                                                {{-- </div> --}}
                                                        @endforeach
                                                    </div>
                                                </div>
                                            @endforeach

                                        </div>
                                    </div>
                                </div>
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
