<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
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
        return view('user.index', ['users' => $users]);
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
        try {
            DB::beginTransaction();
            print_r($request->input());

            // User::create($request->all());
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);

            $user->save();
            $empresa = Empresa::find($request->empresa_id);
            $user->empresa()->attach($empresa->id);
            DB::commit();
        } catch (Exception $ex) {
            DB::rollback();
            return $ex->getMessage();
        }
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
        // $msg = 'Dados alterados com sucesso';
        // $status = 'success';
        $user = User::findOrFail($id);
        if (isset($user->roles->first()->id) && $user->roles->first()->id == 1) {
            $msg = 'não é possivel alterar roles e permissions de usuario master';
            $status = 'danger';
            return redirect()->back()->with('message', ['status' => $status, 'msg' => $msg]);
        }
        $roles = Role::select('name')->orderBy('name', 'ASC')->get();
        // $roles = Role::orderBy('name', 'DESC')->pluck('name', 'name')->all();

        // return $user->roles;

        $userLogado = User::findOrFail(Auth::user()->id);
        // if(isset($userLogado->roles->first()->id) && $userLogado->roles->first()->id == 3){
        //     // $roles = Role::orderBy('name', 'DESC')->whereLike('name','%tenant%')->pluck('name', 'name')->get();
        //     $roles = Role::where('name','like','%tenant%')->orderBy('name', 'ASC')->get();
        //     // $roles = Role::where('name','like','%tenant%')->orderBy('name', 'DESC')->pluck('name', 'name')->get();
        // }
        // if(isset($user->roles->first()->id) && $user->roles->first()->id == 2){
        //     $roles = Role::orderBy('name', 'DESC')->pluck('name', 'name')->where('name','!like','%tenant%')->get();
        // }

        $userRoles = $user->roles->pluck('name', 'name')->all();
        // return redirect()->back()->with('message', ['status' => $status, 'msg' => $msg]);
        return view('user.edit',['user'=>$user,'userLogado'=>$userLogado,'roles'=>$roles, 'userRoles'=>$userRoles]);
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
        $msg = 'não é possivel deletar usuario master';
        $status = 'danger';
        if ($user->roles->first()->id != 1) {
            $user->delete();
            $msg = 'User ' . $user->name . ' deleted';
            $status = 'success';
        }
        return redirect()->back()->with('message', ['status' => $status, 'msg' => $msg]);
    }

    public function storeRoleToUser(Request $request, User $user)
    {
        //atualiza permissoes do usuario
        $user->syncRoles($request->input('RolesUser'));
        return redirect()->route('users.index')->with('message', ['status' => 'success', 'msg' => 'Role updated to user ' . $user->name]);
    }
}
