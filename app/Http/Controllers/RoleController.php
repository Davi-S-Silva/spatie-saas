<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Exceptions\UnauthorizedException;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller implements HasMiddleware
{
    /**
     * Display a listing of the resource.
     */

    public static function middleware(): array
    {
        return [
            // examples with aliases, pipe-separated names, guards, etc:
            // 'role_or_permission:manager|edit articles',
            new Middleware('permission:Deletar Regra', only: ['destroy']),
            new Middleware('permission:Visualizar Regra', only: ['index', 'show']),
            new Middleware('permission:Editar Regra', only: ['edit', 'update']),
            new Middleware('permission:Criar Regra', only: ['create', 'store']),
            new Middleware('permission:Modificar Permissao Regra', only: ['addEditPermissionToRole', 'storePermissionToRole']),
            // new Middleware(\Spatie\Permission\Middleware\RoleMiddleware::using('manager'), except:['show']),
            // new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('delete role'), only:['destroy']),
        ];
    }
    // public function __construct()
    // {
    //     $this->middleware('permission:delete role',['only'=>['destroy']]);
    // }
    public function index()
    {
        $roles = Role::get();

        return view('role-permission.role.index', ['roles' => $roles]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('role-permission.role.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {

            $request->validate([
                'RoleName' => ['required', 'string', 'unique:permissions,name']
            ]);

            // echo json_encode($request->input());

            Role::create([
                'name' => $request->RoleName
            ]);

            // echo json_encode($request->input('PermissionName'));

            echo json_encode(['status' => 'success', 'msg' => 'Role criada com sucesso!']);

            // echo response()->json([
            //     'status'=>'error',
            //     'msg'=>'Permissao necessaria',
            //     'responseMessage' => 'You do not have the required authorization.',
            //     'responseStatus'  => 403,
            // ]);

            // session(['message'=>['status'=>'success', 'msg'=>'Role criada com sucesso!']]);
            session()->flash('message', ['status' => 'success', 'msg' => 'Role criada com sucesso!']);
            return;
        } catch (Exception $ex) {
            echo json_encode(['status' => 'danger', 'msg' => $ex->getMessage()]);
            session()->flash('message', ['status' => 'danger', 'msg' => $ex->getMessage()]);
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
        try {
            $role = Role::find($id);
            if (!$role) {
                throw new Exception('0');
                // abort(403,'não existe');
            }
            // return $role;
            return view('role-permission.role.edit', ['role' => Role::find($role->id)]);
        } catch (Exception $ex) {
            if ($ex->getMessage() == '0') {
                abort(403);
            }
            return $ex->getMessage();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        try {
            $request->validate([
                'RoleName' => ['required', 'string', 'unique:roles,name,' . $role->id]
                // 'PermissionName'=> ['required', 'string', 'unique:permissions,name']
            ]);

            // echo json_encode($request->input());


            $role->update([
                'name' => $request->RoleName
            ]);

            echo json_encode(['status' => 'success', 'msg' => 'Role Atualizada com sucesso!']);
            session()->flash('message', ['status' => 'success', 'msg' => 'Role Atualizada com sucesso!']);
            return;
        } catch (Exception $ex) {
            if ($ex->getMessage() == '0') {
                abort(403);
            }
            return $ex->getMessage();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        try {
            if($role->id !==1){
                $role->delete();
                echo json_encode(['status' => 'success', 'msg' => 'Role Deleted Successfuly']);
                // session(['message'=>['status'=>'success', 'msg'=>'Role Deleted Successfuly']]);
                session()->flash('message', ['status' => 'success', 'msg' => 'Role Deleted Successfuly!']);
                return;
            }
            echo json_encode(['status' => 'success', 'msg' => 'não é possivel deletar essa role!']);
            session()->flash('message', ['status' => 'danger', 'msg' => 'não é possivel deletar essa role!']);
                return;
        } catch (Exception $ex) {
            echo json_encode(['status' => 'danger', 'msg' => $ex->getMessage()]);
            return;
        }
    }

    public function addEditPermissionToRole(string $roleId)
    {
        $permissions = Permission::orderBy('model', 'asc')->orderBy('name', 'asc')->Get();
        // $perm = [];
        // foreach($permissions as $permission){
        //     $perm[$permission->model][]=(object)$permission;
        // }
        // return $perm;

        $role = Role::findOrFail($roleId);
        $rolePermission = DB::table('role_has_permissions')
            ->where('role_id', $roleId)
            ->pluck('permission_id', 'permission_id')
            ->all();

        return view('role-permission.role.add-permissions', ['role' => $role, 'permissions' => $permissions, 'rolePermission' => $rolePermission]);
    }

    public function storePermissionToRole(Request $request, string $roleId)
    {
        // echo '<pre>';print_r($request->input());echo '</pre>';

        // return;

        $request->validate([
            'permission' => 'required'
        ]);

        $role = Role::findOrFail($roleId);

        $role->syncPermissions($request->input('permission'));

        return redirect()->route('users.index')->with('message', ['status' => 'success', 'msg' => 'Permission updated to role ' . $role->name]);
        // print_r($role->getAttributes());
    }
}
