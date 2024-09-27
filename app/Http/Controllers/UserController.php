<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\Models\FuncaoColaborador;
use App\Models\Municipio;
use App\Models\TipoColaborador;
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
            new Middleware('permission:Deletar Usuario', only: ['destroy']),
            new Middleware('permission:Show Usuario', only: ['show']),
            new Middleware('permission:Listar Usuario', only: ['index']),
            new Middleware('permission:Editar Usuario', only: ['edit', 'update']),
            new Middleware('permission:Criar Usuario', only: ['create', 'store']),
            new Middleware('permission:Modificar Role Usuario', only: ['storeRoleToUser']),
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
            // print_r($request->input());

            // User::create($request->all());
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $empresa = Empresa::find($request->empresa_id);
            if($empresa->id != 1){
                $user->tenant_id = $empresa->tenant_id;
            }
            $user->save();
            $user->empresa()->attach($empresa->id);
            if($empresa->id == 1){
                $user->roles()->attach(4);//
            }else{
                $user->roles()->attach(5);//
            }
            if(!is_null($request->colaborador_id)){
                $ColabUser = DB::table('colaborador_user')->where('colaborador_id',$request->colaborador_id)->get();

                if($ColabUser->count()!=0){
                    throw new Exception('Colaborador ja tem Usuario atribuido');
                }
                $user->colaborador()->attach($request->colaborador_id);
            }
            DB::commit();
            return 'usuario cadastrado e atribuido ao colaborador com sucesso';
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
        $TipoColaborador = TipoColaborador::orderby('tipo','asc')->get();
        $cidades = Municipio::orderBy('nome', 'asc');
        // $cidades = DB::table('municipios');
        // $ufs = ['PE','PB','AL','RN'];
        // $ufs = ['26','25','27','43'];
        // $cidades->whereIn('estado_id', $ufs);
        $cidadesGet = $cidades->with('estado')->get();
        $FuncaoColaborador = FuncaoColaborador::orderby('funcao','asc')->get();
        return view('user.edit',['user'=>$user,'userLogado'=>$userLogado,'roles'=>$roles, 'userRoles'=>$userRoles,'TipoColaborador'=>$TipoColaborador,'FuncaoColaborador'=>$FuncaoColaborador,'cidades'=>$cidadesGet]);
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
        $msg = 'não é possivel deletar este usuario';
        $status = 'danger';
        if ($user->roles->first()->name != 'super-admin' && $user->roles->first()->name != 'tenant-admin-master') {
            $user->delete();
            $msg = 'User ' . $user->name . ' deleted';
            $status = 'success';
        }
        return redirect()->back()->with('message', ['status' => $status, 'msg' => $msg]);
    }

    public function storeRoleToUser(Request $request, User $user)
    {
        //atualiza permissoes do usuario
        if (isset($user->roles->first()->id) && ($user->roles->first()->name == 'super-admin' || $user->roles->first()->name == 'tenant-admin-master')) {
            $msg = 'não é possivel alterar roles e permissions de usuario master';
            $status = 'danger';
            return redirect()->back()->with('message', ['status' => $status, 'msg' => $msg]);
        }
        $user->syncRoles($request->input('RolesUser'));
        return redirect()->route('users.index')->with('message', ['status' => 'success', 'msg' => 'Role updated to user ' . $user->name]);
    }
}
