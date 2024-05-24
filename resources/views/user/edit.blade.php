<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User Edit') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="card col-12">
                    <div class="card-header col-12 m-0 p-0">
                        <h4 class="p-3 m-0 d-flex justify-between align-items-center">
                            User <a href="{{ route('users.index') }}" class="btn btn-primary m-0">Users</a></h4>
                    </div>
                    <div class="card-body">
                        @can('Modificar Role Usuario')
                            <form action="{{ route('users.store-give-role-user', ['user' => $user->id]) }}" method="post" class="col-3">
                                <fieldset>
                                    <legend>User Role Permissons</legend>
                                    @csrf
                                    @method('PUT')
                                        <select name="RolesUser[]" multiple id="" class="form-select form-select-lg mb-3">
                                            @foreach ($roles as $role)
                                            <option value="{{ $role }}"
                                            {{ in_array($role, $userRoles) ? 'selected' : '' }}>{{ $role }}
                                        </option>
                                        @endforeach
                                    </select>
                                    <input type="submit" value="Atualizar" class="btn btn-primary">
                                </fieldset>
                            </form>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
