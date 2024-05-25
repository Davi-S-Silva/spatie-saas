<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Arr;
use Spatie\Permission\Models\Role;

class UserController extends Controller implements HasMiddleware
{
    /**
     * Display a listing of the resource.
     */

     public static function middleware(): array
    {
        return [
            // examples with aliases, pipe-separated names, guards, etc:
            // 'role_or_permission:manager|edit articles',
            new Middleware('permission:Deletar Usuario', only: ['destroy']),
            new Middleware('permission:Visualizar Usuario', only: ['index', 'show']),
            new Middleware('permission:Editar Usuario', only: ['edit', 'update']),
            new Middleware('permission:Criar Usuario', only: ['create', 'store']),
            new Middleware('permission:Modificar Role Usuario', only: ['storeRoleToUser']),
            // new Middleware(\Spatie\Permission\Middleware\RoleMiddleware::using('manager'), except:['show']),
            // new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('delete role'), only:['destroy']),
        ];
    }
    public function index()
    {
        $users = User::all();
        return view('user.index', ['users'=>$users]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        print_r($request->input());

        User::create($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);

        $roles = Role::orderBy('name','DESC')->pluck('name','name')->all();
        $userRoles = $user->roles->pluck('name','name')->all();

        return view('user.edit',['user'=>$user,'roles'=>$roles, 'userRoles'=>$userRoles]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {


        // return $user->getRoleNames();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->back()->with('message',['status'=>'success','msg'=>'User '.$user->name.' deleted']);
    }

    public function storeRoleToUser(Request $request , User $user){
        //atualiza permissoes do usuario
        $user->syncRoles($request->input('RolesUser'));
        return redirect()->back()->with('message',['status'=>'success','msg'=>'Role updated to user '.$user->name]);
    }
}
